<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'id' => '73c42a7f-2f4a-4665-8f20-bbabdd680259',
            'title' => "Avis",
            'description' => "https://www.avis.com",
        ]);
        Supplier::create([
            'id' => '6135b5d6-ee28-11ec-8ea0-0242ac120002',
            'title' => "Buchbinder",
            'description' => "https://www.Buchbinder.com",
        ]);
        Supplier::create([
            'id' => '3100675b-d0f3-4e18-963e-211a380a40ca',
            'title' => "Enterprise",
            'description' => "https://www.Enterprise.com",
        ]);
        Supplier::create([
            'id' => 'ce7a25aa-ee28-11ec-8ea0-0242ac120002',
            'title' => "Global rent a Car",
            'description' => "https://www.global-rent-a-car.com",
        ]);
    }
}
