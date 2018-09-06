<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace FondOfSpryker\Zed\BrandDataImport\Business\Model\Reader;

use Orm\Zed\Brand\Persistence\FosBrand;

interface BrandReaderInterface
{
    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrand $brandEntity
     *
     * @return void
     */
    public function addBrand(FosBrand $brandEntity);
}
