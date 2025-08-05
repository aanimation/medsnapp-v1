<?php

/**
 * PUSH NOTIFICATION
 */

namespace App\Http\Gamification\Admin;

use Illuminate\Support\Facades\Http;

use Livewire\Component;
use Livewire\WithPagination;

use Carbon\Carbon;
use App\Traits\WithSwal;

use App\Models\{Broadcast as BroadcastModel, User};

/* Push Notification OR Broadcast Message */
class Notification extends Component
{
    use WithSwal;

    public $search = '';
    public $pageCount = 50;
    protected $paginationTheme = 'bootstrap';

    public $dateSchedule, $timeSchedule;
    public $title, $message, $targetUrl;
    public $target;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    protected function rules() {
        return [
            'title' => 'required',
            'message' => 'required',
            'target' => '',
            'dateSchedule' => '',
            'timeSchedule' => '',
        ];
    }

    public function boot()
    {
        $this->dateSchedule = now()->format('Y-m-d');
        $this->timeSchedule = now()->addHour()->format('H:i');
    }

    function pushNotification($content)
    {
        $beamsInstanceId = config('services.pusher.beams_instance_id');
        $beamsSecret = config('services.pusher.beams_secret_key');

        $content = [
            "interests" => $content['interests'],
            "web" => [
                "notification" => [
                    "title" => $content['title'],
                    "body" => $content['body'],
                    "deep_link" => $content['deep_link'],
                    "icon" => "https://medsnapp.com/assets/img/logos/new-logo.png"
                ]
            ]
        ];

        $response = Http::withToken($beamsSecret)
        ->post("https://{$beamsInstanceId}.pushnotifications.pusher.com/publish_api/v1/instances/{$beamsInstanceId}/publishes", $content);

        return $response->body();
    }

    public function storeMessage()
    {
        $this->validate();

        BroadcastModel::create([
            'title' => $this->title,
            'message' => $this->message,
            'target_url' => $this->targetUrl ?? null,
            'schedule' => Carbon::parse("{$this->dateSchedule} {$this->timeSchedule}"),
            'target' => $this->target,
            'status' => 'pending'
        ]);

        $this->pushNotification([
            'interests' => ['medsnapp-campaign-'.config('app.env')],
            'title' => $this->title,
            'body' => $this->message,
            'deep_link' => $this->targetUrl ?? config('app.platform_url'),
        ]);

        $this->NormalSuccessAlert();

        $this->reset();
    }

    public function getData()
    {
        // $users = User::whereNotNull('web_token')->paginate($this->pageCount);
        $history = BroadcastModel::whereNull('deleted_at')->paginate($this->pageCount);

        return [
            // 'users' => $users,
            'history' => $history,
        ];
    }

    public function render()
    {
        return view('gamification.admin.notification', $this->getData());
    }
}