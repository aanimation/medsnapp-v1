<?php

namespace App\Http\Gamification\User;

use Illuminate\Support\Facades\{Auth, Http, Mail};

use Livewire\Component;
use PlutoLinks\Loops\Laravel\Facades\Loops;

use App\Mail\PlayerWelcome;
use App\Traits\WithSwal;
use App\Models\{
    User as UserModel,
    UserInfo, UserAtts, 
    Country, University,
    Master
};

class Profile extends Component
{
    use WithSwal;

    protected UserModel $userModel;
    protected $currentUserId;

    // public $captcha = 0;
    
    public $universities;
    public $countryCode;

    public $username;
    public $email;
    //public $phone_number;
    public $firstname;
    public $surname;
    public $speciality;
    
    public $country;
    public $university;

    public $type;
    public $profession;
    public $student_type;
    public $other; // other profession

    //public $dob;

    public function rules(){
        return [
            // 'captcha'       => 'required',
            'username'      => 'required|min:3|max:20|unique:users,username,'.$this->currentUserId,
            'firstname'     => 'required|min:2|max:15',
            'surname'       => 'required|min:2|max:15',
            'speciality'    => 'required',
            'country'       => 'required',
            'university'    => 'required_if:type,==,student',
            'type'          => 'required',
            'student_type'  => 'required_if:type,==,student',
            'profession'    => 'required_if:type,==,professional',
            'other'         => 'required_if:type,==,other',
        ];
    }

    public function messages() 
    {
        return [
            'username.unique'   => 'Username not available',
            '*.required'        => 'This field is missing.',
            '*.required_if'     => 'The field is required depend type.',
            '*.numeric'         => 'This field must be a number.',
        ];
    }

    protected $listeners = ['setNextBoard'];

    public function setNextBoard()
    {
        // Determine session then update onboard progress
        if (session()->has('next-route-num')) {
            if (session()->get('next-route-num') == 0) {
                session()->put('next-route-num', 1);

                return redirect()->route('help');
            }
        }

        $this->userModel->updateQuietly(['is_active' => true]);

        return redirect()->route('player-dashboard');
    }

    public function boot()
    {
        $userId = Auth::user()->id;
        $model = UserModel::with(['Info', 'Atts:user_id,health,points,coins,exps'])->whereId($userId)->first();

        $this->userModel = $model;
        $this->currentUserId = $model->id;
    }

    public function mount()
    {
        $this->username = $this->userModel->username;
        $this->email = $this->userModel->email;
        $info = $this->userModel->Info;
        $this->firstname = $info->firstname ?? null;
        $this->surname = $info->lastname ?? null;
        $this->speciality = $info->speciality ?? null;
        $this->type = $info->type ?? null;
        $this->other = $info->other ?? null;
        $this->profession = $info->profession ?? null;
        $this->student_type = $info->student_type ?? null;
        $this->country = $info->country ?? null;
        if($this->country){
            $this->universities = University::whereCountryId($this->country)->get(['id','country_id', 'name']);
            $this->countryCode = Country::find($this->country)->num_code;
        }else{
            $this->universities = University::limit(1)->get(['id','country_id', 'name']);
        }
        $this->university = $info->university ?? null;
    }

    public function updatedUsername($value)
    {
        $this->username = strtolower($this->username);
    }

    public function updatedCountry($value)
    {
        $this->reset('countryCode', 'university', 'universities');
        
        $this->universities = University::whereCountryId($value)->get(['id', 'country_id', 'name']);
        $this->countryCode = Country::find($value)->num_code;
    }

    /*
    public function updatedCaptcha($token)
    {
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . config('app.recaptcha_secret_key_v3') . '&response=' . $token);
        $this->captcha = $response->json()['score'];
     
        if (!$this->captcha > .3) {
            $this->updateProfile();
        } else {
            return redirect()->back()->with('status', 'Google thinks you are a bot, please refresh and try again');
        }
    }
    */

    public function updateProfile()
    {
        $message = 'Your changes have been saved.';

        $this->validate();

        $isStudent = $this->type == 'student';
        $isPro = $this->type == 'healthcare professional';
        $isOther = $this->type == 'other';

        UserInfo::UpdateOrCreate([
            'user_id' => $this->currentUserId,
        ],[
            'firstname' => $this->firstname,
            'lastname' => $this->surname,
            'speciality' => $this->speciality,
            
            'country' => $this->country,
            'university' => $this->university,
            
            'type' => $this->type,
            'is_student' => $isStudent,
            'student_type' => $isStudent ? $this->student_type : null,
            'profession' => $isPro ? $this->profession : null,
            'other' => $isOther ? $this->other : null,
        ]);

        
        if(!$this->userModel->Atts) {
            // Init health only at on first save, other fields are default
            UserAtts::UpdateOrCreate([
                'user_id' => $this->currentUserId,
            ],[
                'health' => 100,
                'exps'   => 10,
            ]);
        }


        if(!$this->userModel->is_active && !$this->userModel->is_lock) {
            $this->userModel->update([
                'username' => $this->username,
                // 'is_active' => true, // deprecated, see OnBoarding component
            ]);

            if(App()->isProduction() && session()->get('next-route-num') == 0) {
                // send email notification
                $transactionId = config('loops.transactional.welcome');
                $dataVariables = [
                    'name' => ucfirst($this->surname ?? $this->firstname ?? $this->username ?? 'Player'),
                ];
                Loops::transactional()->send($transactionId, $this->email, $dataVariables);
            }else{
                Mail::to($this->email)->send(new PlayerWelcome($this->email, $this->firstname, $this->surname, $this->username));
            }

            $message = 'Your changes have been saved. Go to Patient to treat your next patient.';

            // Show first completed profile for next onboard step
            $this->dispatch('completedProfileAlert');
        }

        $this->userModel->update([
            'username' => $this->username,
        ]);

        return session()->flash('profile-saved', $message);
    }

    protected function getData()
    {
        $countries = Country::orderBy('name', 'asc')->get(['id','name', 'num_code']);
        $masters = Master::query();

        $specialities = $masters->clone()->whereName('speciality')->first(['content']);
        $students = $masters->clone()->whereName('student')->first(['content']);
        $professions = $masters->clone()->whereName('profession')->first(['content']);

        return [
            'item'              => $this->userModel,
            'currentUserAtts'   => $this->userModel->Atts,
            'countries'         => $countries,
            'specialities'      => $specialities->content,
            'students'          => $students->content,
            'professions'       => $professions->content,
            'types'             => ['student', 'healthcare professional', 'other'],
        ];
    }

    public function render()
    {
        return view('gamification.user.profile', $this->getData());
    }
}
