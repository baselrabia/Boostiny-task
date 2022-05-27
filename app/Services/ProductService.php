<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    /**@var ProductRepository $productRepo product repository instance */
    public $productRepo;

    /**
     * __construct function
     *
     * @param ProductRepository $productRepo
     */
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    /**
     * List products
     *
     *
     * @return collection
     */
    public function list()
    {
        return $this->productRepo->query()->with('seller')->paginate(20);
    }

    /**
     * Get product by id
     *
     * @param int $id
     * @return collection
     */
    public function get($id)
    {
        return $this->productRepo->find($id);
    }






}
