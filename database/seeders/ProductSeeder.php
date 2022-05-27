<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->delete();
        DB::table('products')->delete();
        DB::table('sellers')->delete();

        Seller::factory()->times(20)->create()->each(function ($seller) {
            Product::factory()->times(500)->create([
                'seller_id' => $seller->id,
            ]);
        });

    }
}
