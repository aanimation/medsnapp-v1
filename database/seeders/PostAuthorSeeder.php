<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stephenjude\FilamentBlog\Models\Author;

class PostAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = new Author();
        $item->name = 'Author-name';
        $item->email = 'admin@medsnapp.dev';
        $item->photo = null;
        $item->bio = 'Author';
        $item->save();
    }
}
