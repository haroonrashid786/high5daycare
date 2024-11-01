<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Admin',        'status' => 1]);
        Role::create(['name' => 'Franchise',    'status' => 1]);
        Role::create(['name' => 'Parent',       'status' => 1]);
    }
}
