<?php

namespace FondOfSpryker\Zed\BrandDataImport\Business\Model;

use Orm\Zed\Brand\Persistence\FosBrandQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class BrandWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    protected const BULK_SIZE = 100;
    protected const KEY_NAME = 'name';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $this->findOrCreateBrand($dataSet);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return \Orm\Zed\Brand\Persistence\FosBrand
     */
    protected function findOrCreateBrand(DataSetInterface $dataSet)
    {
        $brandEntity = FosBrandQuery::create()
            ->filterByName($dataSet[static::KEY_NAME])
            ->findOneOrCreate();

        $brandEntity->fromArray($dataSet->getArrayCopy());

        if ($brandEntity->isNew() || $brandEntity->isModified()) {
            $brandEntity->save();
        }

        return $brandEntity;
    }
}
