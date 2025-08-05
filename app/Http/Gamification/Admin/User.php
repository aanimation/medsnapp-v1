<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\{DB, Mail};
use App\Mail\PlayerReminder;
use App\Traits\WithSwal;

use App\Models\User as UserModel;

class User extends Component
{
    use WithPagination, WithSwal;

    public $search = '';
    public $pageCount = 50;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function openDetail($key)
    {
        return redirect()->route('user-detail', $key);
    }

    public function getData()
    {
        $keySearch = "%{$this->search}%";

        $users = UserModel::
        when($keySearch, function($query) use($keySearch) {
            $query->where('role_id', '<>', 3)->where('name', 'like', $keySearch)->orWhere('email', 'like', $keySearch);
        })
        ->whereRoleId(3)
        ->whereNotIn('username', ['superadmin', 'admin', 'operator'])
        ->orderBy('created_at', 'DESC')
        ->paginate($this->pageCount);

        return [
            'data' => $users
        ];
    }

    public function unlock($id)
    {
        $user = UserModel::find($id);
        $user->updateQuietly(['is_locked' => !$user->is_locked]);
    }

    public function reminder($id)
    {
        $user = UserModel::find($id);

        if(config('app.env') === 'production') {
            $domainApp = 'platform';
        }elseif(config('app.env') === 'staging') {
            $domainApp = 'staging';
        }else{
            $domainApp = 'development';
        }
        
        $siteUrl = config('sites.urls.'.$domainApp);
        $activateLink = "{$siteUrl}/verify/player/{$user->verify_code}/new";

        Mail::to($user->email)->send(new PlayerReminder($user->email, $user->name, $activateLink));
        
        $user->updateQuietly(['updated_at' => now()]);

        $this->SuccessfullAlert('Reminder sent');
    }

    public function render()
    {
        return view('gamification.admin.user', $this->getData());
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatePageCount($pageCount)
    {
        $this->pageCount = $pageCount;
    }
}