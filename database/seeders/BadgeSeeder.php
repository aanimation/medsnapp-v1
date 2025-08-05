<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = \File::get(base_path('database/seeders/badges.json'));
        $decode = json_decode($json);

        foreach ($decode as $value) {
            Badge::create([
                'order' => $value->order,
                'badge_name' => $value->title,
                'requirement' => $value->requirement,
                'category' => $value->cat,
            ]);
        }
    }
}
