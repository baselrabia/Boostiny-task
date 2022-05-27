<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // one seller
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    // many orders
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
