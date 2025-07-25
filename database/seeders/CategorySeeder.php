<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // Truncate the categories table
    Category::truncate();

    // Re-enable foreign key checks
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $categories = [
            'Personal Development - Self-Help',
            'Technology - Gadgets - Programming',
            'Health & Fitness',
            'Finance - Investing - Money',
            'Travel',
            'Food & Cooking',
            'Fashion & Lifestyle',
            'Education - Career - Student Life'
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create([
                'name' => $category,
            'slug' => Str::slug($category)]);
        }
    }

}
