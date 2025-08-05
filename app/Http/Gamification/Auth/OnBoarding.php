<?php

namespace App\Http\Gamification\Auth;

use Illuminate\Support\Facades\Route;

use Livewire\Component;

use App\Traits\WithBadges;

class OnBoarding extends Component
{
    use WithBadges;

    public int $currentStep = 0;
    public bool $isFinished = false;

    protected $onboardRoutes = ['player-profile', 'help', 'shop', 'lobby'];

    public function mount()
    {
        if (session()->has('next-route-num')) {
            $this->currentStep = session()->get('next-route-num');

            $this->isFinished = Route::currentRouteName() == $this->onboardRoutes[3];
        }
    }

    public function setNextBoard(int $step = 0)
    {
        if ($this->currentStep === $step) {
            $nextStep = $step + 1;
            session()->put('next-route-num', $nextStep);

            return redirect()->route($this->onboardRoutes[$nextStep]);
        }
    }

    //TODO: Prev button & review Middleware
    public function setPrevBoard(int $step = 1)
    {
        if ($this->currentStep === $step && $step !== 0) {
            $prevStep = $step - 1;
            session()->put('next-route-num', $prevStep);

            return redirect()->route($this->onboardRoutes[$prevStep]);
        }
    }

    public function destroyBoard()
    {
        $user = auth()->user();
        $user->updateQuietly(['is_active' => true, 'is_new' => false]);

        session()->forget('next-route-num');

        $this->ApplyBadge($user->id, 'Level 1');

        sleep(3);

        return redirect()->route('player-dashboard');
    }

    protected function getData()
    {
        $user = auth()->user();
        $isProfileCompleted = !is_null($user->Info);

        return [
            'profileCompleted' => $isProfileCompleted,
        ];
    }

    public function render()
    {
        return view('gamification.auth.onboarding', $this->getData());
    }
}
