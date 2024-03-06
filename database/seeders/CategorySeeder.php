<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::factory(10)->create();

        $categories->each(function (Category $category) {
            \App\Models\CategoryTranslation::factory()->create(['category_id' => $category->id]);
        });
    }
}
