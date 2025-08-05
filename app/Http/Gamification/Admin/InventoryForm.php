<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;

use App\Models\Scenario as Quest;
use App\Models\{Inventory, InvComponent, InvQuestValue, UserQuestInv};

class InventoryForm extends Component
{
    public $stepsIncl = ['pending','Pending','Compatible','compatible'];

    public $e = []; // examination
    public $i = []; // investigation
    public $t = []; // treatment
    public $i_ext = []; // for step 2
    public $t_rec = []; // recovery
    
    public $patient;

    public $tre_name, $tre_depend, 
    $tre_alt1, $tre_alt2, $tre_alt3, $tre_alt4, $tre_alt5;

    public function mount(string $key)
    {
        $this->patient = Quest::find($key);
        
        $patient = $this->patient;

        /* examination */        
        $this->getDataExamination($patient);

        /* investigation */
        $this->getDataInvestigation($patient);

        /* treatment */
        $this->getDataTreatment($patient);
    }

    protected function getDataExamination($patient)
    {
        $masterExa = Inventory::with(['Value' => function($query) use($patient) {
            $query->whereScenarioId($patient->id);
        }])->whereType('examination')->orderBy('id', 'ASC')->get(['id', 'specifications']);
        foreach($masterExa as $ex){
            $specs = json_decode($ex->Value->first()->specifications, true);
            foreach($specs as $idx => $spec){
                $this->e[$ex->id][$idx] = $spec;
            }
        }
    }

    protected function getDataInvestigation($patient)
    {
        $masterComps = InvComponent::with(['ComValue' => function($query) use($patient) {
            $query->whereScenarioId($patient->id);
        }])->get();
        foreach($masterComps as $comp){
            $this->i[$comp->id] = $comp->patient_val;
            if(in_array($comp->patient_val, $this->stepsIncl)) {
                $this->i_ext[$comp->id] = $comp->pasca_val;
            }
        }
    }

    protected function getDataTreatment($patient)
    {
        if($treats = InvQuestValue::whereNull('com_id')->whereNull('specifications')
            ->whereScenarioId($patient->id)
            ->whereHas('Inventory')
            ->with('Inventory')
            ->get(['id', 'inv_id', 'alternates', 'is_optional', 'depend_by', 'recovery'])){
            $this->t = $treats->toArray();

            /**
             * recovery value
             * $ref = [ 6 => 1000, 7 => 600, 9 => 875, 12 => 930, 10 => 1114, 11 => 767];
             */
            foreach ($treats as $item) {
                //$item->updateQuietly(['recovery' => $ref[$patient->id]]);
                $this->t_rec[$item->id] = $item->recovery ?? 0;
            }
        }
    }
    
    public function updated($field, $fieldValue)
    {
        $idRow = explode('.', $field);

        if($idRow[0] === 'e'){
            if($row = InvQuestValue::whereInvId($idRow[1])->whereScenarioId($this->patient->id)->first()){
                $row->updateQuietly([
                    'specifications' => json_encode($this->e[$idRow[1]])
                ]);
            }
        }

        if($idRow[0] === 'i'){
            if($row = InvQuestValue::whereComId($idRow[1])->whereScenarioId($this->patient->id)->first()){
                if(strtolower($fieldValue) === 'pending'){
                    $row->updateQuietly(['patient' => $fieldValue]);
                }else{
                    $row->updateQuietly([
                        'patient' => $fieldValue,
                        'pasca' => null,
                        'description' => null
                    ]);
                }
            }
        }

        if($idRow[0] === 'i_ext'){
            if($row = InvQuestValue::whereComId($idRow[1])->whereScenarioId($this->patient->id)->first()){
                $row->updateQuietly([
                    'pasca' => $fieldValue,
                    'description' => "Select another investigation then reselect {$row->inv_name} to view the result.",
                ]);
            }
        }

        if($idRow[0] === 't_rec'){
            InvQuestValue::find($idRow[1])
            ->updateQuietly(['recovery' => $fieldValue]);
        }
    }

    public function setNewValue($comId, $invId)
    {
        InvQuestValue::updateOrCreate([
            'inv_id' => $invId,
            'com_id' => $comId,
            'scenario_id' => $this->patient->id,
        ],[
            'patient' => $this->i[$comId],
        ]);
    }

    public function addNewSpec($exaId)
    {
        $item = InvQuestValue::whereScenarioId($this->patient->id)->whereInvId($exaId)->first();
        $specs = json_decode($item->specifications, true);
        $specs[] = 'empty';
        $item->updateQuietly(['specifications' => json_encode($specs)]);

        $this->getDataExamination($this->patient);
    }

    public function deleteSpec($exaId, $idx)
    {
        $item = InvQuestValue::whereScenarioId($this->patient->id)->whereInvId($exaId)->first();
        $specs = json_decode($item->specifications, true);
        unset($specs[$idx]);
        $item->updateQuietly(['specifications' => json_encode($specs)]);

        $this->getDataExamination($this->patient);
    }

    public function addMoreTreatment()
    {
        $invId = $this->getInvIdByName($this->tre_name);
        
        $dependId = null;
        if($this->tre_depend){
            $dependId = $this->getInvIdByName($this->tre_depend);
        }

        $alts = [];
        for($i=1; $i<6; $i++){
            if($alt = $this->{'tre_alt'.$i}){
                $alts[] = $this->getInvIdByName($alt);
            }
        }

        $newTre = [
            'scenario_id' => $this->patient->id,
            'inv_id' => $invId,
            'depend_by' => $dependId,
            'alternates' => count($alts) ? $alts : null,
        ];

        InvQuestValue::updateOrCreate($newTre, ['updated_at' => now()]);

        $this->reset('tre_name', 'tre_depend', 'tre_alt1', 'tre_alt2', 'tre_alt3', 'tre_alt4', 'tre_alt5');

        $this->getDataTreatment($this->patient);
    }

    public function deleteTrea($treId)
    {
        $item = InvQuestValue::find($treId);

        /**
         * check users_quests_invs
         * reset update `is_correct` and clean `exp` as rewards while correct
         */
        if($records = UserQuestInv::whereInvId($item->inv_id)->whereIsCorrect(true)->get()) {
            foreach($records as $rec) {
                $rec->updateQuietly(['is_correct' => false, 'exp' => 0]);
            }
        }

        $item->delete();

        $this->getDataTreatment($this->patient);
    }

    function getInvIdByName($input)
    {
        $expl = explode(' | ', $input);
        return Inventory::whereType('treatment')->whereName($expl[0])->when(isset($expl[1]), function($query) use($expl){ $query->where('specifications', '"'.$expl[1].'"'); })->first()->id;
    }

    public function getData()
    {
        $patient = $this->patient;

        $examination = Inventory::with([
            'Value' => function($query) use($patient) {
                $query->whereScenarioId($patient->id);
            }
        ])
        ->whereType('examination')->orderBy('id', 'ASC')->get();

        $investigation = Inventory::with([
            'Components', 
            'Components.ComValue' => function($query) use($patient) {
                $query->whereScenarioId($patient->id);
            },
            'Value' => function($query) use($patient) {
                $query->whereScenarioId($patient->id);
            }
        ])->whereType('investigation')->orderBy('id', 'ASC')->get();

        $treatment = Inventory::with([
            'Value' => function($query) use($patient) {
                $query->whereScenarioId($patient->id);
            }
        ])
        ->whereType('treatment')->orderBy('name', 'ASC')->get();

        return [
            'patient' => $patient,
            'examination' => $examination,
            'investigation' => $investigation,
            'treatment' => $treatment,
        ];
    }

    public function render()
    {
        return view('gamification.admin.inventory-form', $this->getData());
    }
}