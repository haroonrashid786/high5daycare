<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $usercheck = User::where('email', 'dev@hashedsystem.com')->first();
        if ($usercheck != null){
            $usercheck->delete();
        }
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'dev@hashedsystem.com';
        $user->password = Hash::make('123456');
        $user->save();

        $user->assignRole('Admin'); 
    }
}
