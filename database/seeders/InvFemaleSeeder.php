<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Inventory;
use App\Models\InvComponent;
use App\Models\InvQuestValue;

class InvFemaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // RUN this `artisan db:seed --class=InvFemaleSeeder`
        // CONVERTER https://www.convertcsv.com/csv-to-json.htm

        // $json = \File::get(base_path('database/seeders/inv_female_updates.json'));
        // $decode = json_decode($json);

        // foreach ($decode as $value) {
        //     if($item = InvComponent::whereTitle($value->title)->first()) {
        //         if(is_null($item->female)){
        //             $item->update(['female' => $value->female]);
        //         }
        //     }
        // }

        // $json = \File::get(base_path('database/seeders/inv_patient_updates.json'));
        // $decode = json_decode($json);

        // foreach ($decode as $value) {
        //     if($item = InvComponent::whereTitle($value->title)->first()) {
        //         $item->update(['patient' => $value->patient]);
        //     }
        // }


        // $json = \File::get(base_path('database/seeders/examination_updates.json'));
        // $decode = json_decode($json);

        // foreach ($decode as $value) {
        //     if($item = Inventory::whereName($value->name)->first()) {
        //         $item->update(['specifications' => json_encode($value->spec)]);
        //     }
        // }


        /* FOR ID 8 => Anaphylaxis*/
        $json = \File::get(base_path('database/seeders/examination_updates.json'));
        $decode = json_decode($json);

        foreach ($decode as $idx => $value) {
            InvQuestValue::create([
                'inv_id' => $idx + 1,
                'scenario_id' => 8,
                'specifications' => $value->spec,
                // 'category' => $value->cat,
                // 'type' => 'examination',
                // 'name' => $value->name,
                // 'price' => $value->price,
                // 'icon' => $value->icon,
            ]);
        }

    }
}
