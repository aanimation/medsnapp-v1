<?php

/**
 * USER NOTIFS
 */

namespace App\Http\Gamification\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Traits\{WithSwal, WithNotification};

use App\Models\{User, UserNotif};

class Notifs extends Component
{
    use WithSwal, WithNotification;

    public $search = '';
    public $pageCount = 50;
    protected $paginationTheme = 'bootstrap';

    public $title, $description;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    protected function rules() {
        return [
            'title' => 'required',
            'description' => 'required',
        ];
    }

    public function sendMessage()
    {
        $this->validate();

        $userIds = User::whereNull('deleted_at')
            ->whereIsActive(true)
            ->whereIsLocked(false)
            ->whereNotNull('email_verified_at')
            ->where('signin_times', '>', 0)
            ->pluck('id');
        // dd($userIds);

        foreach ($userIds as $userId) {
            $this->addAdminNotification([
                'title' => $this->title,
                'description' => $this->description,
            ],$userId);
        }

        $this->NormalSuccessAlert();

        $this->reset();
    }

    public function getData()
    {
        $history = UserNotif::whereNotNull('notification_id')->paginate($this->pageCount);

        return [
            'history' => $history,
        ];
    }

    public function render()
    {
        return view('gamification.admin.notifs', $this->getData());
    }
}