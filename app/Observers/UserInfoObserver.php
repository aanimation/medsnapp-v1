<?php

namespace App\Observers;

use Illuminate\Support\Facades\Http;

use App\Models\UserInfo;

class UserInfoObserver
{

    public function created(UserInfo $item): void
    {
        if(App()->isProduction()) {
            if($makeWebhookUrl = config('services.make.webhook_url')) {
                Http::post($makeWebhookUrl, [
                    'email' => $item->email,
                    'firstname' => $item->firstname,
                    'lastname' => $item->lastname,

                    'country' => $item->Country->name ?? '',
                    'university' => $item->University->name ?? '',
                    'type' => $item->type,
                    'student_type' => $item->is_student ? $item->student_type : null,
                    'profession' => $item->profession,
                ]);
            }
        }
    }

}
