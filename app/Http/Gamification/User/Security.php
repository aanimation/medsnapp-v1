<?php

namespace App\Http\Gamification\User;

use Livewire\Component;

use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\{Auth, Hash, Mail};

use App\Mail\AccountDeletion;
use App\Models\{LoginAttempt, User as UserModel};
use App\Traits\WithSwal;

class Security extends Component
{
    use WithSwal;

    protected UserModel $userModel;
    protected $userId;

    public $email;
    public $passwordType = 'password';
    public $username;
    public $hasGoogleId = false;

    public $currentPassword = '';
    public $password = '';
    public $confirmPassword = '';

    protected function rules() {
        return [
            'currentPassword'   => ['required','string'],
            'password'          => ['required','string', Password::defaults()->mixedCase()->numbers()->symbols()],
            'confirmPassword'   => ['required','string', 'same:password'],
        ];
    }

    protected function messages() {
        return [
            '*.required' => 'req',
            '*.min' => 'min',
            '*.mixed' => 'mix',
            '*.symbols' => 'sym',
            '*.numbers' => 'num',
            '*.same' => 'same',
        ];
    }

    public function boot()
    {
        $this->userId = auth()->id();
        $model = UserModel::find($this->userId);
        $this->userModel = $model;
        $this->username = $this->userModel->username;
        $this->email = $this->userModel->email;
    }

    public function mount()
    {
        // if user registered with google
        if($this->userModel->google_id){
            $this->hasGoogleId = true;
            $this->currentPassword = $this->userModel->google_id;
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    protected function getData()
    {
        // $activities = LoginAttempt::whereUserId($this->userId)->orderBy('id', 'DESC')->get();
        return [
            // 'activities' => $activities,
            'item' => $this->userModel,
        ];
    }

    public function updatePassword()
    {
        $this->validate();

        if (!auth()->attempt(['email' => $this->userModel->email, 'password' => $this->currentPassword])
        && !$this->userModel->google_id) {
            $this->UnsuccessfullAlert('Current password is incorrect');
            $this->reset('currentPassword');
            return;
        }

        $this->userModel->updateQuietly([
            'password' => Hash::make($this->confirmPassword),
        ]);

        $this->reset('currentPassword', 'password', 'confirmPassword');

        $this->NormalSuccessAlert();

        //TODO: sent email notification of change password
        return;
    }

    public function deactivateAccount()
    {
        $user = UserModel::find(auth()->id());
        $user->updateQuietly(['is_deleted' => true, 'deleted_at' => now()]);

        Mail::to($this->email)->send(new AccountDeletion($this->email, $user->username));

        $this->NormalSuccessAlert();

        Auth::logout();

        return redirect()->route('login')->with('status', 'Deactivation account has requested.');
    }

    public function render()
    {
        return view('gamification.user.security', $this->getData());
    }

    public function togglePasswordType()
    {
        $this->passwordType = $this->passwordType === 'password' ? 'text' : 'password';
    }

}
