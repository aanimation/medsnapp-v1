<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

use PlutoLinks\Loops\Laravel\Facades\Loops;

use App\Mail\EmailNotification;
use App\Models\User as UserModel;

class SendEmailNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email-notifications {target=development@medsnapp.com}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification via email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $target = $this->argument('target');
        Mail::to($target)->send(new EmailNotification(''));
        $this->info("Sending email to: {$target}");

        $this->__blastNewPatientCaseInfo();
        Log::info(['message' => 'cron-job done']);
        $this->info("Blasting info new patient was done");
    }

    function __blastNewPatientCaseInfo()
    {
        $users = UserModel::with(['Info'])
            ->whereIsActive(true)
            ->whereIsLocked(false)
            ->whereIsNew(false)
            ->whereNull('verify_code')
            ->whereRoleId(3)
            ->where('signin_times', '>', 1)
            ->get();

        foreach ($users as $user) {
            try{
                $transactionId = config('loops.transactional.new-patient');
                $dataVariables = ['lastName' => $user->Info->lastname ?? $user->Info->firstname ?? 'MedSnapp Member']; 

                // Loops::transactional()->send($transactionId, $user->email, $dataVariables);
            }catch(Exception $e) {
                Log::warning(['message' => $e->getMessage(), 'loc' => 'cron-job']);
            }
        }

        return;
    }

    /**
     * HPanel
     * 
     * /usr/bin/php /home/u522337597/public_html/staging/project/artisan app:send-email-notifications
     * 
     * 
     * 0 16 * * 2   /usr/bin/php /home/u522337597/public_html/staging/project/artisan app:send-email-notifications
     */
}
