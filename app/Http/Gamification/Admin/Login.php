<?php

namespace App\Http\Gamification\Admin;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{

    public $username='';
    public $password='';

    protected $rules= [
        'username' => 'required',
        'password' => 'required'

    ];

    public function render()
    {
        return view('gamification.admin.login');
    }

    public function mount() {
      
        $this->fill(['username' => 'admin', 'password' => 'password']);    
    }
    
    public function store()
    {
        $attributes = $this->validate();

        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }

        session()->regenerate();

        return redirect('/manage/dashboard');

    }
}
