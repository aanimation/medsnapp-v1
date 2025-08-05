<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\QuestionCat;

class QuestCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Medicine', // parent 1
            'Surgery', // parent 2

            // sub of Medicine
            'Cardiology', // 2
            'Endocrinology', //3
            'Gastroenterology', //4
            'Geriatric medicine',
            'Haematology',
            'Immunology',
            'Infectious diseases',
            'Metabolic medicine',
            'Nephrology',
            'Neurology',
            'Oncology',
            'Palliative care',
            'Respiratory',
            'Dermatology', // 15

            // sub of Surgery
            'Anaesthetics and perioperative care',
            'Breast',
            'Colorectal',
            'General surgery',
            'Neurosurgery',
            'Paediatric surgery',
            'Upper GI and hepatobiliary',
            'Urology',
            'Vascular',
        ];

        foreach($categories as $idx => $item) {
            QuestionCat::create([
                'name' => $item,
                'parent_id' => $idx > 1 ? ($idx > 15 ? 2 : 1) : null,
                'order' => $idx
            ]);
        }
    }
}
