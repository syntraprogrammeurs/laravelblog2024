<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->call([
            PhotosTableSeeder::class,
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            UsersRolesTableSeeder::class,
            CategorySeeder::class,
            PostsTableSeeder::class,
            PostCategoryTableSeeder::class,
            PostCommentSeeder::class,
            KeywordsTableSeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductCategorySeeder::class,
            Product_ProductCategorySeeder::class,
        ]);
       //DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
