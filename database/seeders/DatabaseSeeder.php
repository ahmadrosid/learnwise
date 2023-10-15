<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // uncomment these lines below then run `php artisan migrate:refresh seed`
        /*
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(3)->create();
        \App\Models\Chapter::factory(8)->create();
        */
    }
}
