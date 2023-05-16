<?php

namespace Database\Seeders;

use App\Models\ConfigurationStore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConfigurationStore::create([
            'code' => 'STORE-001',
            'name' => 'Ida Shop',
            'address' => 'Jl. Raya Kedung Halang No. 1',
            'phone' => '081234567890',
            'email' => 'idashop@mail.com',
            'open_at' => '08:00:00',
            'close_at' => '17:00:00',
            'shipping_cost' => 10000,
            'is_active' => true,
        ]);
    }
}
