<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = Role::all();
        User::all()->each(function($user) use ($roles){
           $user->roles()->attach(
                $roles->random(rand(1,3))->pluck('id')->toArray()
           );
        });
    }
}
