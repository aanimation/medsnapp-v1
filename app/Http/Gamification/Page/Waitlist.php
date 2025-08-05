<?php

namespace App\Http\Gamification\Page;

use Illuminate\Support\Facades\{Http, Mail, Log};

use Livewire\Component;
use Exception;

use App\Mail\NewSubscription;
use App\Models\Waitlist as WaitlistModel;
use App\Traits\beehiivTraits;

class Waitlist extends Component
{
    use beehiivTraits;

    private $mailto = 'development@medsnapp.com';
    public $email = '';

    protected $rules = [
        'email' => 'required|email',
    ];

    protected $messages = [
        'email.required' => 'Email cannot be blank',
        'email.email' => 'Invalid email format',
    ];


    public function submitForm()
    {
        $this->validate();

        $email = $this->email;
        if(!$email){
            return;
        }

        // try this webhook of make.com
        // https://hook.eu2.make.com/jar9lj826k6kbqk25wjjji866p2hp7l1

        try{
            $formConfig = config('services.getlaunchlist.form');
            $response = Http::post($formConfig['url'].$formConfig['code'], [
                'email' => $email,
            ]);
        }catch(Exception $e) {
            Log::error(['message' => $e->getMessage(), 'loc' => 'waitlist']);
        }

        /*try{
            $this->beehiivCreateSubscription($email); // NO API KEY
        }catch(Exception $e) {
            dump($e->getMessage());
        }*/

        WaitlistModel::updateOrCreate(['email' => $this->email],[
            'notes' => $response->status(),
            'status' => 'done',
            'completed_at' => now(),
        ]);

        session()->flash('success', 'Email successfully registered.');

        Mail::to($this->mailto)->send(new NewSubscription($email, 'data new sub'));

        $this->reset(); 

        // redirect to new tab 
        // https://getlaunchlist.com/s/T8RNuK/arham@medsnapp.com?confetti=fire
    }

    public function render()
    {
        return view('gamification.page.waitlist');
    }
}
