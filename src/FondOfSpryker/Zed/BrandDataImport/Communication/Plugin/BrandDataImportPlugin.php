<?php

namespace FondOfSpryker\Zed\BrandDataImport\Communication\Plugin;

use FondOfSpryker\Zed\BrandDataImport\BrandDataImportConfig;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\BrandDataImport\Business\BrandDataImportFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\BrandDataImport\BrandDataImportConfig getConfig()
 */
class BrandDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null)
    {
        return $this->getFacade()->import($dataImporterConfigurationTransfer);
    }

    /**
     * @return string
     */
    public function getImportType(): string
    {
        return BrandDataImportConfig::IMPORT_TYPE_BRAND;
    }
}
