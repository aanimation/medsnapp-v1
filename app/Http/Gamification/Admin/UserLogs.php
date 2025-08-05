<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;
use Livewire\Attributes\Url;
use Exception;

use App\Models\{
    User as UserModel, 
    UserAttsLog,

    UserQuest,
    UserQuestInv,

    QuestionUser,
    QuestionSession
};

class UserLogs extends Component
{
    #[Url] 
    public $tab = 'question';

    public $key, $model;
    public $userLogs, $patientLogs, $questionLogs, $questionSessionLogs; 

    public function mount()
    {
        try {
            $this->model = UserModel::where('skey', $this->key)->firstOrFail();
        } catch(Exception $e) {
            return redirect()->route('user-list');
        }

        $userId = $this->model->id;
        $this->userLogs = UserAttsLog::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $this->patientLogs = UserQuest::with('Quest')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $this->questionLogs = QuestionUser::with('Question')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $this->questionSessionLogs = QuestionSession::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }

    public function changeTab($tab)
    {
        $this->tab = $tab;
    }

    public function render()
    {
        return view('gamification.admin.user-logs');
    }

}