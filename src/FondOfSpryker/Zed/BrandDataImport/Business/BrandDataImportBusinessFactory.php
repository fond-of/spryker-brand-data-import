<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace FondOfSpryker\Zed\BrandDataImport\Business;

use FondOfSpryker\Zed\BrandDataImport\Business\Model\BrandWriterStep;
use FondOfSpryker\Zed\BrandDataImport\Business\Model\Reader\BrandReader;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\BrandDataImport\BrandDataImportConfig getConfig()
 */
class BrandDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function createBrandImporter()
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($this->getConfig()->getBrandDataImporterConfiguration());

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker
            ->addStep(new BrandWriterStep($this->createBrandRepository()));

        $dataImporter
            ->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    /**
     * @return \FondOfSpryker\Zed\BrandDataImport\Business\Model\Reader\BrandReaderInterface
     */
    protected function createBrandRepository()
    {
        return new BrandReader();
    }
}
