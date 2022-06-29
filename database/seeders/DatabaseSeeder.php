<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CarTypeSeeder::class,
            CarSpecificationSeeder::class,
            BrandSeeder::class,
            RentalTypeSeeder::class,
            FuelPolicySeeder::class,
            SupplierSeeder::class,
            InsurancePolicySeeder::class
        ]);
    }
}
