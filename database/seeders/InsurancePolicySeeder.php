<?php

namespace Database\Seeders;

use App\Models\InsurancePolicy;
use App\Models\RentalType;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class InsurancePolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InsurancePolicy::create([
            'id' => '434fd4e3-b109-4f4d-9704-c5bc165e3f26',
            'description' => "Lorem ipsum dolor sit amet",
            'cost' => '5',
            'cost_unit' => 'euro',
            'title' => 'Saver'
        ]);
        InsurancePolicy::create([
            'id' => '8341080b-0f2a-44d1-90a6-7e6c6afd7b7a',
            'description' => "All things including car damage cost",
            'cost' => '10',
            'cost_unit' => 'euro',
            'title' => 'Premium'
        ]);
    }
}
