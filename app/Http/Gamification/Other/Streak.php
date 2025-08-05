<?php

namespace App\Http\Gamification\Other;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Streak as StreakModel;

class Streak extends Component
{
    public $userId;
    public int $streakCount = 0;
    public $today, $yesterday, $todayStreak, $yesterdayStreak;
    public $greetings = ['Let start', 'Great start', 'Great start', 'Great start', 'Great start', 'Great start', 'Great start', 'Amazing'];

    public function mount()
    {
        $this->userId = auth()->id();

        $this->streakCount = $this->getStreakCount();
    }

    function getStreakCount()
    {
        $this->today = Carbon::now()->dayName;
        $this->yesterday = Carbon::yesterday()->dayName;
        $this->todayStreak = StreakModel::whereUserId($this->userId)->where('day_date', Carbon::now()->format('Y-m-d'))->first();
        $this->yesterdayStreak = StreakModel::whereUserId($this->userId)->where('day_date', Carbon::yesterday()->format('Y-m-d'))->first();

        if($lastIndex = StreakModel::whereIsConnected(false)->whereUserId($this->userId)->orderBy('id', 'DESC')->first()) {
            if($this->todayStreak) {
                return StreakModel::where('id', '>=', $lastIndex->id)->where('id', '<=', $this->todayStreak->id)->count();
            }

            if($this->yesterdayStreak) {
                return StreakModel::where('id', '>=', $lastIndex->id)->where('id', '<=', $this->yesterdayStreak->id)->count();
            }

        }

        return 0;
    }

    function getData()
    {
        $data = $days = [];
        $firstIndex = null;
        $firstDay = Carbon::now()->dayName;

        // Try get first index streak which by default is connected as false
        if($firstStreak = StreakModel::whereIsConnected(false)->whereUserId($this->userId)->whereDate('day_date', '>', Carbon::now()->subDays(7))->orderBy('id', 'DESC')->first()){
            $firstIndex = $firstStreak->id;
            $firstDay = Carbon::parse($firstStreak->day_date)->dayName;
        }

        // The main query
        $query = StreakModel::whereIsConnected(true)
        ->whereUserId($this->userId)
        ->when($firstIndex, function($sub) use($firstIndex){
            $sub->where('id', '>', $firstIndex);
        })
        ->orderBy('id', 'DESC')
        ->whereDate('day_date', '>', Carbon::now()->subDays(7))
        ->limit(7)
        ->get();

        if($query->count() > 0){
            // Only when week streak not completed yet
            if($query->count() < 7){
                $data[$firstDay] = 0;
            }
            // Reverse query to get the days sorted
            foreach($query->reverse() as $item){
                $day = Carbon::parse($item->day_date)->dayName;
                $data[$day] = $item->id;
            }
        }

        // Last check data for today exists
        if(!StreakModel::whereUserId($this->userId)->where('day_date', Carbon::now()->format('Y-m-d'))->exists()) {
            unset($data[$this->today]); 
        }

        // prepare empty days
        if(count($data) > 0 && count($data) < 7){
            for($i=1; $i<=(7 - count($data)); $i++){
                $nextDay = Carbon::parse($query->first()->day_date)->addDays($i)->dayName;
                $days[$nextDay] = $i;
            }
        }

        if(count($data) == 0){
            $days[$firstDay] = 0;

            if($this->yesterdayStreak){
                $days[$this->yesterday] = 0;
                $days[$this->today] = 1;
            }

            if($this->todayStreak){
                $days[$this->today] = 0;
            }

            for($i=1; $i<=7; $i++){
                $nextDay = Carbon::now()->addDays($i)->dayName;
                $days[$nextDay] = $i;
            }

        }

        // Reset data and days if 3 days off streak
        if(!StreakModel::whereUserId($this->userId)->whereDate('day_date', '>', Carbon::now()->subDays(3))->exists()){
            $data = $days = [];
            for($i=0; $i<=7; $i++){
                $nextDay = Carbon::now()->addDays($i)->dayName;
                $days[$nextDay] = $i;
            }
        }

        return [
            'data' => $data,
            'days' => $days,
        ];
    }

    public function render()
    {
        return view('gamification.other.streak', $this->getData());
    }

    public function goStreak()
    {
        return redirect()->route('questions');
    }

}
