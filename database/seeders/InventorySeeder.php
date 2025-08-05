<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Inventory;
use App\Models\InvComponent;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // RUN this `artisan db:seed --class=InventorySeeder`

        $json = \File::get(base_path('database/seeders/inventories1.json'));
        $decode = json_decode($json);

        $tempName = null;
        $tempId = null;
        foreach ($decode as $value) {
            if($value->name){
                $tempName = $value->name;
                $inv = Inventory::firstOrCreate([
                    'name' => $value->name,
                    'price' => $value->price ?? 0,
                    'price2' => is_null($value->price) ? 0 : (($value->price >= 1 && $value->price <= 3) ? $value->price + 1 : $value->price + 2),
                    'type' => $value->type,
                ],[
                    'specifications' => $value->specifications ?? null,
                    'category' => $value->cat,
                    'icon' => $value->type == 'investigation' ? 'syringe' : $value->icon,
                    'damage' => $value->type == 'examination' ? $value->damage : 0,
                ]);

                //then

                if(isset($value->component)) {
                    InvComponent::firstOrCreate([
                        'title' => $value->component,
                    ],[
                        'inv_id' => $inv->id ?? Inventory::whereName($value->name)->first()->id,
                        'normal' => $value->value,
                        'female' => $value->female,
                        'unit' => $value->unit,
                    ]);

                    $tempId = $inv->id;
                }
            }else{
                InvComponent::firstOrCreate([
                    'title' => $value->component,
                ],[
                    'inv_id' => $tempId ?? Inventory::whereName($tempName)->first()->id,
                    'normal' => $value->value,
                    'unit' => $value->unit,
                ]);
            }

        }

        // at last
        Inventory::create([
           "name" => "Recovery Item",
           "damage" => 0,
           "value" => null,
           "unit" => null,
           "price" => 30,
           "price2" => 25,
           "cat" => "Recovery Patient",
           "description" => "Restore your patient's health",
           "icon" => "medical_services",
           "type" => "recovery",
        ]);
    }
}
