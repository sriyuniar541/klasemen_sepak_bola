<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Klub;

class KlubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('klub')->truncate();

        DB::table('klub')->insert([
            [
                'nama_klub' => 'Klub A',
                'kota_klub' => 'Kota A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_klub' => 'Klub B',
                'kota_klub' => 'Kota B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_klub' => 'Klub C',
                'kota_klub' => 'Kota C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
