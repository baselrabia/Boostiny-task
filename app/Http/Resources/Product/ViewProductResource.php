<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ViewProductResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'description'  => $this->description,
            'price'        => $this->price,
            'quantity'     => $this->quantity,
            'seller_id'    => $this->seller_id,
            'seller_name'  =>  $this->whenLoaded('seller')->name ??  $this->seller->name ?? null,

            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:m:s') : '',
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:m:s') : '',
    ];
    }
}
