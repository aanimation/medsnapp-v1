<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master as MasterModel;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterModel::create([
            'name' => 'speciality',
            'content' => [
                'Medicine',
                'Surgery',
                'General Practice',
                'Radiology',
                'Anaesthetics',
                'Psychiatry',
                'Paediatrics',
                'Pathology',
                'Emergency medicine',
                'Obstetrics and Gynaecology',
                'Orthopaedics',
                'Ear, nose and throat',
                'Ophthalmology',
            ]
        ]);

        MasterModel::create([
            'name' => 'profession',
            'content' => [
                'Doctor',
                'Nurse',
                'Physician Associate',
                'Pharmacist',
                'Physiotherapist',
                'Occupational Therapist',
                'Speech and Language Therapist',
                'Podiatrist',
                'Dietician',
                'Psychologist',
                'Dentist',
                'Optometrist',
            ]
        ]);

        MasterModel::create([
            'name' => 'student',
            'content' => [
                'Medicine',
                'Nursing',
                'Physician Associate Studies',
                'Pharmacy',
                'Physiotherapy',
                'Occupational Therapy',
                'Speech and Language Therapy',
                'Podiatry',
                'Nurtition and Dietician',
                'Psychology',
                'Dentistry',
                'Optometry',
            ]
        ]);


    }
}
