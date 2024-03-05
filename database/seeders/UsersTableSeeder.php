<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'name'=>'Tom',
           'is_active'=>1,
           'email'=>'syntraprogrammeurs@gmail.com',
           'photo_id'=>1,
            'password'=> Hash::make('12345678'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name'=>'Tim',
            'is_active'=>1,
            'email'=>'anderemail@gmail.com',
            'photo_id'=>1,
            'password'=> Hash::make('12345678'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        User::factory()->count(50)->create();
    }
}
