<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            [
                'name' => 'Bank Indonesia',
                'image' => 'bank/bank_indonesia.png',
            ],
            [
                'name' => 'Bank BRI',
                'image' => 'bank/bank_bri.jpg',
            ],
            [
                'name' => 'Bank Mandiri',
                'image' => 'bank/bank_mandiri.jpg',
            ],
            [
                'name' => 'Bank BNI',
                'image' => 'bank/bank_bni.png',
            ],
            [
                'name' => 'Bank BTN',
                'image' => 'bank/bank_btn.png',
            ],
        ];
            
        \DB::table('banks')->insert($banks);
    }
}
