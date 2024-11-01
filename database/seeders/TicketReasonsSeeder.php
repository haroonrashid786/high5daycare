<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reasons = [
            ['name' => 'Technical Support'],
            ['name' => 'Financial Dues'],
            ['name' => 'Daycare'],
            ['name' => 'Suggesstions'],
            ['name' => 'Complaints'],
            ['name' => 'Other'],

        ];

            DB::table('ticket_reasons')->insert($reasons);
    }
    
}
