<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stephenjude\FilamentBlog\Models\Category;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = new Category();
        $item->name = 'Medicine';
        $item->slug = 'medicine';
        $item->description = 'Medicine';
        $item->is_visible = true;
        $item->save();

        $item = new Category();
        $item->name = 'Guides';
        $item->slug = 'guides';
        $item->description = 'Guides';
        $item->is_visible = true;
        $item->save();

        $item = new Category();
        $item->name = 'Applications';
        $item->slug = 'applications';
        $item->description = 'Applications';
        $item->is_visible = true;
        $item->save();
    }
}
