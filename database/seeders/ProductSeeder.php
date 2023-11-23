<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "name" => ["laptop","mouse","keyboard","mousepad","kursi"],
            "price" => [1000000,30000,60000,200000,150000]
        ];

        foreach ($data['name'] as $key => $productName) {
            DB::table("products")->insert([
                'product_name' => $productName,
                'price' => $data['price'][$key]
            ]);
        }

    }
}
