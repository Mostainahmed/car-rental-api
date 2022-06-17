<?php
namespace Database\Seeders;
use App\Models\CarType;
use Illuminate\Database\Seeder;

class CarTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarType::create([
            'id' => 'e1fe9282-9d0e-4270-9298-39bc65229xc4',
            'title' => "Small"
        ]);
        CarType::create([
            'id' => 'f41c3a9c-92e9-4238-b0c0-6af05024e980',
            'title' => "Medium"
        ]);
        CarType::create([
            'id' => '174e3269-74ab-4e84-bb3b-33f5956d3098',
            'title' => "Large"
        ]);
        CarType::create([
            'id' => '4ef2ece4-edac-11ec-8ea0-0242ac120i98',
            'title' => "Estate"
        ]);
        CarType::create([
            'id' => 'e5a0458a-fa14-4567-bcaa-0ed9afb42mj8',
            'title' => "Premium"
        ]);
        CarType::create([
            'id' => '83c89f42-c159-4099-aed3-a7ed72669uy6',
            'title' => "SUVs"
        ]);

    }
}
