<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category' => 'food',
            'name' => 'Sapi',
            'weight' => 100,
            'description' => 'Sapi',
            'stock' => 100,
            'price' => 100000,
            'is_active' => 1,
            // 'created_by' => 1,
            // 'updated_by' => 1,
        ]);
    }
}
