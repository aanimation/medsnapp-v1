<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Inventory;
use App\Models\InvComponent;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // artisan db:seed --class=TreatmentSeeder
        // NOTE: will start as id 67

        // Pharmacological 67 - 486
        // $json = \File::get(base_path('database/seeders/inventories2.json'));

        // Non-Pharmacological 487-533
        $json = \File::get(base_path('database/seeders/inventories2-non.json'));
        $decode = json_decode($json);

        foreach ($decode as $value) {
            $inv = Inventory::create([ //firstOrCreate
                'name' => $value->name,
                'specifications' => $value->name2,
                'price' => $value->price ?? 0,
                'type' => 'treatment',
            // ],[
                'price2' => is_null($value->price) ? 0 : (($value->price >= 1 && $value->price <= 3) ? $value->price + 1 : $value->price + 2),
                'deleted_at' => !$value->status ? now() : null,
                'category' => $value->cat,
                'sub1' => $value->sub1,
                'sub2' => $value->sub2,
                'damage' => 0,
                'icon' => 'healing',
            ]);

        }
    }
}
