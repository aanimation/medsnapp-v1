<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Subscription;

class TiersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = \File::get(base_path('database/seeders/tiers.json'));
        $decode = json_decode($json);

        foreach ($decode as $value) {
            $inv = Subscription::create([
                'title' => $value->title,
                'tier_name' => $value->tier_name,
                'tier_desc' => $value->tier_desc,
                'price' => $value->price,
                'total_price' => $value->total_price,
                'size' => $value->size,
                'status' => $value->status,
                'features' => json_encode($value->features),
            ]);
        }
    }
}
