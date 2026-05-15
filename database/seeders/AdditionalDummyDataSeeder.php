<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdditionalDummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 10 more users
        \App\Models\User::factory(10)->create();

        // Generate 30 articles
        \App\Models\Article::factory(30)->create();

        // Generate 50 comments
        \App\Models\Comment::factory(50)->create();
    }
}
