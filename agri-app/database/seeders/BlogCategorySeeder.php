<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'General',
            'Lifestyle',
            'Travel',
            'Design',
            'Creative',
            'Education',
            'Politics',
            'Organic Farming',
            'Livestock & Poultry',
            'Agri-Tech & Innovation',
            'Soil & Fertility',
            'Weather & Climate',
            'Market & Pricing',
        ];

        foreach ($categories as $category) {
            BlogCategory::create(['name' => $category]);
        }

    }
}
