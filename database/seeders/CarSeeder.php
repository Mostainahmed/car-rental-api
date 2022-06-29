<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::create([
            'id' => 'c2bc7c79-9c40-4bfa-8f97-51ae0710pqze',
            'title' => "Mazda",
            "transmission" => "AUTO",
            "brand_id" => "c2bc7c79-9c40-4bfa-8f97-51ae0710by97",
            "car_type_id" => "f41c3a9c-92e9-4238-b0c0-6af05024e980",
            "supplier_id" => "73c42a7f-2f4a-4665-8f20-bbabdd680259",
            "status" => "INACTIVE",
            "current_lat" => 50.15619736234928,
            "current_lng" => 8.637285082491879,
            "location" => ""
        ]);
        Car::create([
            'id' => '23136cb9-75ff-44b4-a739-9e1c5cdadser',
            'title' => "BMW",
            "transmission" => "AUTO",
            "brand_id" => "c2bc7c79-9c40-4bfa-8f97-51ae0710by97",
            "car_type_id" => "f41c3a9c-92e9-4238-b0c0-6af05024e980",
            "supplier_id" => "73c42a7f-2f4a-4665-8f20-bbabdd680259",
            "status" => "INACTIVE",
            "current_lat" => 50.120409935341335,
            "current_lng" => 8.641654867469656,
            "location" => ""
        ]);
        Car::create([
            'id' => '175730b0-40cd-458d-a735-7b213b2d6534',
            'title' => "Audi",
            "transmission" => "AUTO",
            "brand_id" => "c2bc7c79-9c40-4bfa-8f97-51ae0710by97",
            "car_type_id" => "f41c3a9c-92e9-4238-b0c0-6af05024e980",
            "supplier_id" => "73c42a7f-2f4a-4665-8f20-bbabdd680259",
            "status" => "INACTIVE",
            "current_lat" => 50.4320681465434,
            "current_lng" => 8.376419008368583,
            "location" => ""
        ]);
        Car::create([
            'id' => '9e8682bd-f8e6-4e0e-8e68-6c1740a3879i',
            'title' => "Volkswagen",
            "transmission" => "AUTO",
            "brand_id" => "c2bc7c79-9c40-4bfa-8f97-51ae0710by97",
            "car_type_id" => "f41c3a9c-92e9-4238-b0c0-6af05024e980",
            "supplier_id" => "73c42a7f-2f4a-4665-8f20-bbabdd680259",
            "status" => "INACTIVE",
            "current_lat" => 50.12842744232465,
            "current_lng" => 8.935348416446999,
            "location" => ""
        ]);
        Car::create([
            'id' => '98635b70-edc5-11ec-8ea0-0242ac129997',
            'title' => "Mini",
            "transmission" => "AUTO",
            "brand_id" => "c2bc7c79-9c40-4bfa-8f97-51ae0710by97",
            "car_type_id" => "f41c3a9c-92e9-4238-b0c0-6af05024e980",
            "supplier_id" => "73c42a7f-2f4a-4665-8f20-bbabdd680259",
            "status" => "INACTIVE",
            "current_lat" => 50.34889145449041,
            "current_lng" => 9.516250479388448,
            "location" => ""
        ]);
        Car::create([
            'id' => 'eb46260c-ffa6-44ba-9994-aef80d8dk98u',
            'title' => "Jaguar",
            "transmission" => "AUTO",
            "brand_id" => "c2bc7c79-9c40-4bfa-8f97-51ae0710by97",
            "car_type_id" => "f41c3a9c-92e9-4238-b0c0-6af05024e980",
            "supplier_id" => "73c42a7f-2f4a-4665-8f20-bbabdd680259",
            "status" => "BUSY",
            "current_lat" => 50.18219639046297,
            "current_lng" => 8.738003383277059,
            "location" => ""
        ]);
        Car::create([
            'id' => 'cbd68dcc-fa67-44be-a033-a98686bfhfg6',
            'title' => "Mercedes-Benz",
            "transmission" => "AUTO",
            "brand_id" => "c2bc7c79-9c40-4bfa-8f97-51ae0710by97",
            "car_type_id" => "f41c3a9c-92e9-4238-b0c0-6af05024e980",
            "supplier_id" => "73c42a7f-2f4a-4665-8f20-bbabdd680259",
            "status" => "INACTIVE",
            "current_lat" => 50.240749468375185,
            "current_lng" => 8.381977709949457,
            "location" => "Fankfurt am Main"
        ]);
    }
}
