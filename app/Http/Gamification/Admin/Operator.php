<?php

namespace App\Http\Gamification\Admin;

use Illuminate\Support\Facades\Hash;

use Livewire\Component;
use App\Traits\WithSwal;

use App\Models\User as UserModel;

class Operator extends Component
{
    use WithSwal;

    public $name, $email, $password, $newpassword, $phone;
    public $currentEdit;

    public function editDetail($key)
    {
        $this->currentEdit = UserModel::whereSkey($key)->whereRoleId(2)->first();

        $this->name = $this->currentEdit->name;
        $this->email = $this->currentEdit->email;
        $this->password = '*******';//$this->currentEdit->password;
        $this->phone = $this->currentEdit->phone_number;
    }

    public function submitDetail()
    {
        $input = [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone,
        ];

        if($this->newpassword !== null) {
            $input['password'] = Hash::make($this->newpassword);
        }
        
        $this->currentEdit->updateQuietly($input);

        $this->NormalSuccessAlert();

        $this->closeForm();
    }

    public function closeForm()
    {
        $this->reset();
    }

    public function getData()
    {
        $ops = UserModel::whereRoleId(2)->get();

        return [
            'data' => $ops,
        ];
    }

    public function render()
    {
        return view('gamification.admin.operator', $this->getData());
    }
}