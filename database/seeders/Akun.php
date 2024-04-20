<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Akun extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin1',
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('123'),
                'role' => 1,
                'outlet_id' => 1
            ],
            [
                'name' => 'kasir',
                'email' => 'kasir@gmail.com',
                'password' => bcrypt('1234'),
                'role' => 2,
                'outlet_id' => 1
            ],
            [
                'name' => 'pemilik',
                'email' => 'pemilik@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 3,
                'outlet_id' => 1
            ],
        ];

        foreach($data as $key => $d) {
            User::create($d);
        }
    }
}
