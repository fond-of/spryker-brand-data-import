<?php

namespace FondOfSpryker\Zed\BrandDataImport\Business;

use FondOfSpryker\Zed\BrandDataImport\Business\Model\BrandWriterStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

/**
 * @method \FondOfSpryker\Zed\BrandDataImport\BrandDataImportConfig getConfig()
 */
class BrandDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function createBrandImporter(): DataImporterInterface
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($this->getConfig()->getBrandDataImporterConfiguration());

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker
            ->addStep(new BrandWriterStep());

        $dataImporter
            ->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }
}
