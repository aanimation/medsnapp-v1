<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class ReviveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = \File::get(base_path('database/seeders/revives.json'));
        $decode = json_decode($json);

        foreach ($decode as $value) {
            Inventory::create([
                'name' => $value->name,
                'type' => 'recovery',
                'category' => 'Recovery Patient Health',
                'sub1' => null,
                'sub2' => null,
                'description' => 'Instant revive patient health',
                'icon' => $value->icon,
                'price' => $value->price,
                'price2' => $value->price + 2,
                'damage' => $value->damage,
            ]);
        }
    }
}
