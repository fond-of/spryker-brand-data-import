<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace FondOfSpryker\Zed\BrandDataImport\Business\Model;

use FondOfSpryker\Zed\BrandDataImport\Business\Model\Reader\BrandReaderInterface;
use Orm\Zed\Brand\Persistence\FosBrandQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class BrandWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;
    const KEY_NAME = 'name';

    /**
     * @var \FondOfSpryker\Zed\BrandDataImport\Business\Model\Reader\BrandReaderInterface
     */
    protected $brandReader;

    /**
     * @param \FondOfSpryker\Zed\BrandDataImport\Business\Model\Reader\BrandReaderInterface $brandReader
     */
    public function __construct(BrandReaderInterface $brandReader)
    {
        $this->brandReader = $brandReader;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $brandEntity = $this->findOrCreateBrand($dataSet);
        $this->brandReader->addBrand($brandEntity);
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