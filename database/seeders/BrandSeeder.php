<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'id' => 'c2bc7c79-9c40-4bfa-8f97-51ae0710by97',
            'title' => "Mazda",
            'url' => "https://www.mazda.de",
        ]);
        Brand::create([
            'id' => '23136cb9-75ff-44b4-a739-9e1c5cdab634',
            'title' => "BMW",
            'url' => "https://www.bmw.de",
        ]);
        Brand::create([
            'id' => '175730b0-40cd-458d-a735-7b213b2d1462',
            'title' => "Audi",
            'url' => "https://www.audi.de",
        ]);
        Brand::create([
            'id' => '9e8682bd-f8e6-4e0e-8e68-6c1740a3a6cd',
            'title' => "Volkswagen",
            'url' => "https://www.Volkswagen.de",
        ]);
        Brand::create([
            'id' => '98635b70-edc5-11ec-8ea0-0242ac120002',
            'title' => "Mini",
            'url' => "https://www.mini.de",
        ]);
        Brand::create([
            'id' => 'eb46260c-ffa6-44ba-9994-aef80d8d3497',
            'title' => "Jaguar",
            'url' => "https://www.Jaguar.de",
        ]);
        Brand::create([
            'id' => 'cbd68dcc-fa67-44be-a033-a98686bf468c',
            'title' => "Mercedes-Benz",
            'url' => "https://www.Mercedes-Benz.de",
        ]);
    }
}
