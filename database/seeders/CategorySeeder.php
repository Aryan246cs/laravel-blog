<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        Category::all()->each(function ($category) {
            $category->slug = Str::slug($category->name);
            $category->save();
        });

        $categories = [
            'Personal Development / Self-Help',
            'Technology / Gadgets / Programming',
            'Health & Fitness',
            'Finance / Investing / Money',
            'Travel',
            'Food & Cooking',
            'Fashion & Lifestyle',
            'Education / Career / Student Life'
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create(['name' => $category]);
        }
    }

}
