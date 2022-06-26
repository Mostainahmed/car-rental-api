<?php

namespace Database\Seeders;

use App\Models\RentalType;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class RentalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RentalType::create([
            'id' => '434fd4e3-b109-4f4d-9704-c5bc165e3f26',
            'description' => "Minute basis",
            'cost' => '5',
            'cost_unit' => 'euro'
        ]);
        RentalType::create([
            'id' => '8341080b-0f2a-44d1-90a6-7e6c6afd7b7a',
            'description' => "On a Day basis",
            'cost' => '250',
            'cost_unit' => 'euro'
        ]);
    }
}
