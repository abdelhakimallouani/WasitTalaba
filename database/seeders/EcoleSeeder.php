<?php

namespace Database\Seeders;

use App\Models\Ecole;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EcoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ecoles')->insert([
            [
                'nom' => 'ENSA Nador',
                'latitude' => 35.168,
                'longitude' => -2.928,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'ESTO Oujda',
                'latitude' => 34.681,
                'longitude' => -1.908,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'FST Errachidia',
                'latitude' => 31.931,
                'longitude' => -4.424,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
