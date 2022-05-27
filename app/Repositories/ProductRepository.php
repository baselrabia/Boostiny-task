<?php

namespace App\Repositories;

use App\Models\Product;


class ProductRepository extends BaseRepository
{
    /**
     * __constructor
     *
     * @param Product $productModel
     */
    public function __construct(Product $productModel)
    {
        parent::__construct($productModel);
    }


}
