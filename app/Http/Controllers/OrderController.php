<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\Order\ViewOrderResource;
use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{
    /**@var OrderService $orderService */
    public OrderService $orderService;

    /**
     * __constructor
     *
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders  = $this->orderService->ListUserOrders();
        return ViewOrderResource::collection($orders);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        try {
            $order = $this->orderService->createOrder($request->all());
            return SuccessResponse(new ViewOrderResource($order), 'Created Successfully');
        } catch (\Exception $e) {
            return ErrorResponse($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if(auth()->user()->id != $order->user_id){
            return ErrorResponse('You are not authorized to view this order');
        }
        return SuccessResponse(new ViewOrderResource($order), 'Created Successfully');
    }
}
