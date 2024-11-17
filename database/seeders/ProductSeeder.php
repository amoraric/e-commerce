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
        DB::table('products')->insert([
            ['name' => 'Product 1', 'price' => 1.99, 'stock' => 20],
            ['name' => 'Product 2', 'price' => 10.99, 'stock' => 5],
            ['name' => 'Product 3', 'price' => 100.99, 'stock' => 100],
        ]);
    }
}
