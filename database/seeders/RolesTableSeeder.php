<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->insert(['name'=>'administrator']);
        DB::table('roles')->insert(['name'=>'author']);
        DB::table('roles')->insert(['name'=>'subscriber']);
    }
}
