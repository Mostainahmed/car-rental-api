<?php

namespace Database\Seeders;

use App\Models\FuelPolicy;
use Illuminate\Database\Seeder;

class FuelPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FuelPolicy::create([
            'id' => 'f19edb11-c335-4f01-a805-d7b7c4318a25',
            'title' => 'Silver',
            'distance' => 1,
            'distance_unit' => 'kilometer',
            'cost' => 3,
            'cost_unit' => 'EURO'
        ]);
        FuelPolicy::create([
            'id' => '7d3f212a-5ad1-49ad-b675-886ff86af0d8',
            'title' => 'Gold',
            'distance' => 100,
            'distance_unit' => 'kilometer',
            'cost' => 200,
            'cost_unit' => 'EURO'
        ]);
        FuelPolicy::create([
            'id' => '2a270e2a-cae2-4bfd-884d-2b28db4e5283',
            'title' => 'Platinum',
            'distance' => 200,
            'distance_unit' => 'kilometer',
            'cost' => 300,
            'cost_unit' => 'EURO'
        ]);
    }
}
