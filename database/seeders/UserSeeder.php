<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'level' => 'Admin',
            ],
            [
                'name' => 'pembeli1',
                'email' => 'pembeli1@gmail.com',
                'password' => Hash::make('pembeli1'),
                'level' => 'Buyer',
            ],
            [
                'name' => 'pembeli2',
                'email' => 'pembeli2@gmail.com',
                'password' => Hash::make('pembeli2'),
                'level' => 'Buyer',
            ],
            [
                'name' => 'pembeli3',
                'email' => 'pembeli3@gmail.com',
                'password' => Hash::make('pembeli3'),
                'level' => 'Buyer',
            ],
            [
                'name' => 'pembeli4',
                'email' => 'pembeli4@gmail.com',
                'password' => Hash::make('pembeli4'),
                'level' => 'Buyer',
            ],
            [
                'name' => 'penjual1',
                'email' => 'penjual1@gmail.com',
                'password' => Hash::make('penjual1'),
                'level' => 'Seller',
            ],
            [
                'name' => 'penjual2',
                'email' => 'penjual2@gmail.com',
                'password' => Hash::make('penjual2'),
                'level' => 'Seller',
            ],
            [
                'name' => 'penjual3',
                'email' => 'penjual3@gmail.com',
                'password' => Hash::make('penjual3'),
                'level' => 'Seller',
            ],
            [
                'name' => 'penjual4',
                'email' => 'penjual4@gmail.com',
                'password' => Hash::make('penjual4'),
                'level' => 'Seller',
            ],
            [
                'name' => 'petani1',
                'email' => 'petani1@gmail.com',
                'password' => Hash::make('petani1'),
                'level' => 'Farmer',
            ],
            [
                'name' => 'petani2',
                'email' => 'petani2@gmail.com',
                'password' => Hash::make('petani2'),
                'level' => 'Farmer',
            ],
            [
                'name' => 'petani3',
                'email' => 'petani3@gmail.com',
                'password' => Hash::make('petani3'),
                'level' => 'Farmer',
            ],
            [
                'name' => 'petani4',
                'email' => 'petani4@gmail.com',
                'password' => Hash::make('petani4'),
                'level' => 'Farmer',
            ]
        ];
            
        DB::table('users')->insert($users);
    }
}
