<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\{User, UserQuest, Question, Transaction};

class Dashboard extends Component
{
    public $currentUser;

    public function boot()
    {
        $this->currentUser = auth()->user();
    }

    public function getData()
    {
        $newTodayMoney = Transaction::whereDate('created_at', Carbon::today())
        ->whereNotNull('payment_amount')->wherePaymentStatus('paid')->sum('payment_amount');

        $newUserTodayCount = User::whereDate('created_at', Carbon::today())
        ->whereIsActive(true)->whereIsLocked(false)->whereNotNull('email_verified_at')->count();

        $newQuestionsCount = Question::whereMonth('created_at', Carbon::now()->month)->where('user_id', '<>', 1)->count();

        $userQuestTodayCount = UserQuest::whereDate('created_at', Carbon::today())->count();

        $questions = Question::whereNull('approved_at')->get();

        

        return [
            'newTodayMoney' => $newTodayMoney,
            'newUserTodayCount' => $newUserTodayCount,
            'newQuestionsCount' => $newQuestionsCount,
            'userQuestTodayCount' => $userQuestTodayCount,
            'questions' => $questions,
        ];
    }

    public function render()
    {
        return view('gamification.admin.dashboard', $this->getData());
    }
}
