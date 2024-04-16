<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::factory(5)->create();

        $categories->each(function (Category $category) {
            CategoryTranslation::factory()->create(['category_id' => $category->id, 'language_code' => 'nl']);
            CategoryTranslation::factory()->create(['category_id' => $category->id, 'language_code' => 'en']);
        });
    }
}
