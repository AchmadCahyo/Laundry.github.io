<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Outlet;


class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Outlet 1',
                'alamat' => 'Jl. Alamat 1 Kota',
                'telpon' => '089567891234'
            ]
        ];
        foreach($data as $key => $d) {
            Outlet::create($d);
        }
    }
}
