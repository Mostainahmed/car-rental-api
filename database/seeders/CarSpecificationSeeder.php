<?php
namespace Database\Seeders;
use App\Models\CarSpecification;
use App\Models\CarType;
use Illuminate\Database\Seeder;

class CarSpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarSpecification::create([
            'id' => 'aeb2810a-7ac0-45c3-8c79-af68b5673a6e',
            'title' => "Air Conditioning",
            'cost' => 10.00,
            'is_applied_per_km' => false,
            'minimum_travel_distance' => 0.00,
            'is_minimum_travel_distance_applied' => false
        ]);
        CarSpecification::create([
            'id' => 'cab2ab3e-a33b-4d03-bc69-7f29a60a62b7',
            'title' => "4+ doors",
            'cost' => 5.00,
            'is_applied_per_km' => false,
            'minimum_travel_distance' => 0.00,
            'is_minimum_travel_distance_applied' => false
        ]);
        CarSpecification::create([
            'id' => 'a9b55a6e-da50-4598-a6ea-ce831fbe39e1',
            'title' => "Child Seat",
            'cost' => 15.00,
            'is_applied_per_km' => false,
            'minimum_travel_distance' => 0.00,
            'is_minimum_travel_distance_applied' => false
        ]);

    }
}
