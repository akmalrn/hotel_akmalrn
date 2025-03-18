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
        $this->call([
            DatabaseAdminSeeder::class,
            DatabaseConfigurationSeeder::class,
            DatabaseAboutSeeder::class,
            DatabaseSliderSeeder::class,
            DatabaseGallerySeeder::class,
            DatabaseCategoryBlogSeeder::class,
            DatabaseBlogSeeder::class,
            DatabaseHistorySeeder::class,
            ]);
    }
}
