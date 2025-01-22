<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicles')->insert([
            [
                'name' => 'Motorcycle',
                'amount' => '400',
            ],
            [
                'name' => 'Car',
                'amount' => '500',
            ],
            [
                'name' => 'Truck',
                'amount' => '600',
            ],
        ]);
    }
}
