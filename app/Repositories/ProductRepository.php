<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

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


    //list
    public function list()
    {
        $page = request()->page ?? 0;
        // $cachedProducts = Cache::forget('products_' . $page);
        $cachedProducts = Cache::get('products_' . $page);

        if (isset($cachedProducts)) {
            echo "cache layer\n";
            $products = $cachedProducts;
        } else {
            $products = $this->query()->with('seller')->paginate(50);
            Cache::set('products_' . $page, $products);
        }

        return $products;
    }

}
