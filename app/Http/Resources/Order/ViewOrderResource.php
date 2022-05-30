<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class ViewOrderResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id'           => $this->id,
            'product'  =>  $this->whenLoaded('product')->name ??  $this->product->name ?? null,
            'quantity'     => $this->quantity,
            'total'        => $this->total,

            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:m:s') : '',
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:m:s') : '',
    ];
    }
}
