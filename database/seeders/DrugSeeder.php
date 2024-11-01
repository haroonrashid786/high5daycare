<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drugs = [
            ['name' => 'Sunscreen'],
            ['name' => 'Moisturizing skin lotion'],
            ['name' => 'Insect repellent'],
            ['name' => 'Diaper cream'],
            ['name' => 'Lip balm'],
            ['name' => 'Hand sanitizer'],
        ];

            DB::table('drugs')->insert($drugs);
    }
}
