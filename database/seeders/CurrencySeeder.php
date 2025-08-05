<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = \File::get(base_path('database/seeders/currencies.json'));
        $decode = json_decode($json);

        foreach ($decode as $value) {
            Inventory::updateOrCreate([
                'name' => $value->name,
                'type' => 'currency',
                'category' => 'Booster',
                'sub1' => null,
                'sub2' => null,
                'description' => 'Instant boost '.$value->icon.'s',
                'icon' => $value->icon,
            ],[
                'price' => $value->price,
                'price2' => $value->price,
                'price_dec' => $value->price,
                'damage' => $value->damage,
            ]);
        }
    }
}
