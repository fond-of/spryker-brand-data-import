<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace FondOfSpryker\Zed\BrandDataImport\Business\Model\Reader;

use ArrayObject;
use Orm\Zed\Brand\Persistence\FosBrand;

class BrandReader implements BrandReaderInterface
{
    const ID_BRAND = 'id_brand';

    /**
     * @var \ArrayObject
     */
    protected $brandNames;


    public function __construct()
    {
        $this->brandNames = new ArrayObject();
    }

    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrand $brandEntity
     *
     * @return void
     */
    public function addBrand(FosBrand $brandEntity)
    {
        $this->brandNames[$brandEntity->getName()] = [
            static::ID_BRAND => $brandEntity->getIdBrand(),
        ];
    }
}
