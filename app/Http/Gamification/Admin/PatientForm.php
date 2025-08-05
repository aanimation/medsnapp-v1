<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;

use App\Traits\WithSwal;
use App\Models\{Scenario, Inventory, InvQuestValue, InvComponent};

class PatientForm extends Component
{
    use WithSwal;

    public $keyToEdit;

    public $name;
    public $sex;
    public $age;
    public $title;
    public $description;
    public $type;
    public $status;
    public $isTrial;

    public $temp = 0;
    public $hr_rate = 0;
    public $oxy_sat = 0;
    public $bl_press = '100/100';
    public $resp_rate = 0;
    public $curr_health = 15;

    /*
    {"temp": "37.0", "hr_rate": "120", "oxy_sat": "88", "bl_press": "140/90", "resp_rate": "32", "curr_health": "15"}
    */

    protected function rules() {
        return [
            'name'         => 'required|string|min:3',//|unique:scenarios,name',
            'sex'          => 'in:male,female',
            'age'          => 'required',
            'title'        => '',//'unique:scenarios,title',
            'description'  => 'required|string|min:10',

            'temp'          => 'required|numeric|min:10|max:50',
            'hr_rate'       => 'required|numeric|min:10|max:190',
            'oxy_sat'       => 'required|numeric|min:10|max:100',
            'bl_press'      => 'required|min:5',
            'resp_rate'     => 'required|numeric|min:10|max:90',
            'curr_health'   => 'required|numeric|min:15|max:50',

            'type'         => '',//'unique:scenarios,type',
            'isTrial'      => '',
        ];
    }

    protected function messages() 
    {
        return [
            '*.required' => 'This :attribute is missing.',
            'attributes.*.min' => 'This field at least 10 characters length.',
        ];
    }   
    
    public function mount(string $key = null)
    {
        $this->keyToEdit = $key;

        if($key){
            $this->loadPatient($key);
        }
    }

    public function loadPatient(string $key)
    {
        $patient = Scenario::where('skey', $key)->first();
        $this->status = $patient->status;
        $this->name = $patient->name;
        $this->sex = $patient->sex;
        $this->age = $patient->age;
        $this->title = $patient->title;
        $this->description = $patient->description;
        $this->isTrial = $patient->is_trial;

        if(is_array($patient->attributes)){
            $attributes = $patient->attributes;
        }else{
            $attributes = json_decode($patient->attributes, true);
        }

        $this->temp = $attributes['temp'];
        $this->hr_rate = $attributes['hr_rate'];
        $this->oxy_sat = $attributes['oxy_sat'];
        $this->bl_press = $attributes['bl_press'];
        $this->resp_rate = $attributes['resp_rate'];
        $this->curr_health = $attributes['curr_health'];

        $this->type = $patient->type;
    }

    public function updatedIsTrial($value)
    {
        $current = Scenario::where('skey', $this->keyToEdit)->first();
        $current->updateQuietly(['is_trial' => $value ]);
    }

    public function submit(string $status = null)
    {
        $this->validate();

        $new = [
            'name' => $this->name,
            'sex' => $this->sex,
            'age' => $this->age,
            'title' => $this->title,
            'description' => $this->description,
            'attributes'    => [
                'temp'          => $this->temp,
                'hr_rate'       => $this->hr_rate,
                'oxy_sat'       => $this->oxy_sat,
                'bl_press'      => $this->bl_press,
                'resp_rate'     => $this->resp_rate,
                'curr_health'   => $this->curr_health,
            ],
            'attempts'      => json_encode([
                'treatment' => 12,
                'examination' => 5,
                'investigation' => 10
            ]),
            'type' => $this->type,
            'status' => $status ?? 'pending',
            'created_by' => auth()->id(),
            'approved_by' => auth()->id(),
        ];

        if(!$this->keyToEdit) {
            $new['order'] = Scenario::orderBy('order', 'DESC')->first()->order + 1;
        }

        $newCase = Scenario::updateOrCreate(
            [
                'skey' => $this->keyToEdit,
            ], $new
        );

        $newCase->fresh();

        if(!$this->keyToEdit) {
            if($newCase = Scenario::find($newCase->skey)) {
                $freshExa = Inventory::whereType('examination')->get(['id','specifications']);
                foreach($freshExa as $item){
                    InvQuestValue::updateOrCreate([
                        'scenario_id' => $newCase->id,
                        'inv_id' => $item->id,
                    ],[
                        'specifications' => $item->specifications,
                        'updated_at' => now()
                    ]);
                }

                $freshCom = InvComponent::whereNull('deleted_at')->get(['id', 'inv_id','normal','female']);
                foreach($freshCom as $com){
                    InvQuestValue::updateOrCreate([
                        'scenario_id' => $newCase->id,
                        'inv_id' => $com->inv_id,
                        'com_id' => $com->id,
                    ],[
                        'patient' => $this->sex == 'male' ? $com->normal : $com->female,
                    ]);
                }

                // $freshOneTre = Inventory::whereType('treatment')->first(['id']); // get one only as starter treatment
                // InvQuestValue::updateOrCreate([
                //     'scenario_id' => $newCase->id,
                //     'inv_id' => $freshOneTre->id,
                // ],[
                //     'updated_at' => now(),
                // ]);
            }

            $this->reset();
        }

        $this->SuccessfullAlert('Patient saved');
    }


    public function render()
    {
        return view('gamification.admin.patient-form');
    }
}