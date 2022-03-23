<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $API_KEY = '3d88796bedcd30db3b687b6df6f883a0';

    public function run()
    {

        $response = Http::withHeaders([
            'key' => $this->API_KEY
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces = $response['rajaongkir']['results'];

        if ($response['rajaongkir']['status']['code'] == '200') {
            foreach ($provinces as $province) {
                Province::create([
                    'id' => $province['province_id'],
                    'name' => $province['province']
                ]);
    
                $response = Http::withHeaders([
                    'key' => $this->API_KEY
                ])->get('https://api.rajaongkir.com/starter/city?&province=' . $province['province_id'] . '');
    
                $cities = $response['rajaongkir']['results'];
    
                foreach ($cities as $city) {
                    City::create([
                        'id' => $city['city_id'],
                        'province_id' => $province['province_id'],
                        'name' => $city['city_name'],
                        'type' => $city['type'],
                        'postal_code' => $city['postal_code']
                    ]);
                }
            }

        }
    }
}
