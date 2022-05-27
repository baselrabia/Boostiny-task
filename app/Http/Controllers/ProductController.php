<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ViewProductResource;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{

    /**@var ProductService $productService */
    public ProductService $productService;

    /**
     * __constructor
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get list of products
        $Products = $this->productService->list();

        // send json response
        return ViewProductResource::collection($Products);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // send json response
        return SuccessResponse(new ViewProductResource($product), 'Retrieved Successfully');
    }


}
