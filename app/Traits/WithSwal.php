<?php

namespace App\Traits;

use App\Models\{UserInv, UserQuest};

trait WithSwal
{
	public function NormalSuccessAlert()
	{
		return $this->dispatch('swal', 
            title: '<p>success</p>',
            timer: 1000,
            icon: 'success',
            position: 'top-end',
            background: '#262629',
            showConfirmButton: false,
        );
	}

    public function CorrectAnswerAlert()
    {
        return $this->dispatch('swal', 
            title: '<p><strong>Answer Correct</strong><br><br>You gained 1 coin & 1 XP</p>',
            timer: 3000,
            icon: 'success',
            position: 'top-end',
            background: '#262629',
            showConfirmButton: false,
        );
    }

    public function IncorrectAnswerAlert()
    {
        return $this->dispatch('swal', 
            title: '<p><strong>Answer Incorrect</strong></p>',
            timer: 3000,
            icon: 'error',
            position: 'top-end',
            background: '#262629',
            showConfirmButton: false,
        );
    }

    public function CoinsSuccessAlert($coins)
    {
        return $this->dispatch('swal', 
            title: '<p>You gained '.$coins.' coins!</p>',
            timer: 2000,
            icon: 'success',
            position: 'top-end',
            background: '#262629',
            showConfirmButton: false,
        );
    }

    public function HealthSuccessAlert($energy)
    {
        return $this->dispatch('swal', 
            title: '<p>You gained '.$energy.' energy!</p>',
            timer: 2000,
            icon: 'success',
            position: 'top-end',
            background: '#262629',
            showConfirmButton: false,
        );
    }

	public function AttemptEmptyAlert(string $type = '')
	{
		return $this->dispatch('swal', 
            title: "<p>The maximum limit for <b>{$type}s</b> has been reached.</p>",
            timer: 5000,
            icon: 'info',
            position: 'top-end',
            background: '#262629',
            showCloseButton: true,
            showConfirmButton: false,
        );
	}

    public function RestTimeAlert(string $type = '', $rest = '')
    {
        return $this->dispatch('swal', 
            title: "<p>You have reached the maximum number of <b>Treatment</b> items.<br>Return after <b>24 hours</b> to continue treating your patient.</p>", //<p>{$rest}</p>",
            timer: 50000,
            icon: 'info',
            position: 'center',
            background: '#262629',
            showCloseButton: true,
            showConfirmButton: false,
        );
    }

    public function EmptyStockAlert(string $property = '')
    {
        return $this->dispatch('swal', 
            title: "<p>Insufficient {$property}</p>",
            timer: 3000,
            icon: 'info',
            position: 'center',
            background: '#262629',
            showCloseButton: true,
            showConfirmButton: false,
        );
    }

    /*deprecated*/
	public function CompletedProfileAlert()
	{
		return $this->dispatch('swal', 
            title: '<p>Congratulations, you have completed your profile and gained 10 exps!<br>Go to the Help Page to find out about platform walkthrough.</p>',
            timer: 120000,
            icon: 'success',
            position: 'center',
            background: '#262629',
            showCloseButton: true,
            showConfirmButton: false,
        );
	}

	public function AddQuestionAlert()
	{
		return $this->dispatch('swal', 
            title: '<p>Question submitted successfully, and it will review before approved as final, <br><strong>You gained 5 coins</strong></p>',
            timer: 12000,
            icon: 'success',
            position: 'center',
            background: '#262629',
            showCloseButton: true,
            showConfirmButton: false,
        );
	}

    public function UpdateQuestionAlert()
	{
		return $this->dispatch('swal', 
            title: '<p>Question updated successfully</p>',
            timer: 3000,
            icon: 'success',
            position: 'center',
            background: '#262629',
            showCloseButton: true,
            showConfirmButton: false,
        );
	}

    public function DraftQuestionAlert()
    {
        return $this->dispatch('swal', 
            title: '<p>Question saved as draft, you can review and submit by edit</p>',
            icon: 'info',
            position: 'center',
            background: '#262629',
            showCloseButton: true,
            showConfirmButton: false,
        );
    }

	public function AddQuestionErrorAlert()
	{
		return $this->dispatch('swal', 
            title: '<p>Hmm ... something incorrect</p>',
            timer: 12000,
            icon: 'error',
            position: 'top-end',
            background: '#262629',
            confirmButtonText: 'Review back'
        );
	}

    public function UnsuccessfullAlert($message)
    {
        return $this->dispatch('swal', 
            title: '<p>Failed, unsuccessfull</p><p>'.$message.'</p>',
            // timer: 1200000,
            icon: 'error',
            position: 'center',
            background: '#262629',
            showCloseButton: true,
            showConfirmButton: false,
        );
    }

    public function PatientNotHelpedAlert()
    {
        return $this->dispatch('swal', 
            title: '<p>Your patient has sadly passed away.</p><p>Select <b>Revive</b> to restore your patient&quot;s health.</p><p>Select <b>Retry</b> to try again. You will lose 10 Reputation.</p>',
            // timer: 1200000,
            icon: 'error',
            position: 'center',
            background: '#262629',
            showCloseButton: true,
            showConfirmButton: false,
        );
    }

    public function SuccessfullAlert($message, string $title = 'Congratulations!')
    {
        return $this->dispatch('swal', 
            title: '<strong>'.$title.'</strong><p>'.$message.'</p>',
            timer: 120000,
            // icon: 'success',
            position: 'center',
            background: '#262629',
            showCloseButton: true,
            showConfirmButton: false,
        );
    }

    public function NoPatientAlert()
    {
        return $this->dispatch('swal', 
            title: '<strong>Info</strong><br><p>There are currently no more patients to treat.<br>Check again later for new patients.</p>',
            timer: 120000,
            // icon: 'success',
            position: 'center',
            background: '#262629',
            showCloseButton: true,
            showConfirmButton: false,
        );
    }

    public function RequireStepAlert($message)
    {
        return $this->dispatch('swal', 
            text: $message,
            timer: 10000,
            icon: 'info',
            position: 'center',
            background: '#262629',
            showCloseButton: true,
            showConfirmButton: false,
        );
    }
}