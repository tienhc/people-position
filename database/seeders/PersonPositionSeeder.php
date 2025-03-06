<?php

namespace Database\Seeders;

use App\Models\PersonPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'x' => rand(-100, 100) + (rand(0, 99) / 100),
                'y' => rand(-100, 100) + (rand(0, 99) / 100),
            ];
        }

        PersonPosition::insert($data);
    }
}
