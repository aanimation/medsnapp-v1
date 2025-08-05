<?php

namespace App\Http\Gamification\Other;

use Illuminate\Support\Str;
use Livewire\Component;
use Carbon\Carbon;

use App\Models\HeatmapStat as Stat;

class Heatmap extends Component
{
    protected $weeksInYear = 53,
    $daysInWeek = [1 => 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    function getData($week = null, $month = null)
    {
        $stats = Stat::whereUserId(auth()->id())
            ->orderBy('id', 'DESC')
            ->get(['week', 'day_week', 'activity AS sum'])
            ->groupBy('week')
            ->transform(function($item){
                return $item->groupBy('day_week');
            })
            ->toArray();

        $weeksInArray = range($week ?? 1, $this->weeksInYear);
        $series = [];

        foreach($this->daysInWeek as $dayNum => $day){
            $data = [];
            foreach($weeksInArray as $week){
                $stat = 0;
                if(isset($stats[$week][$dayNum])){
                    $stat = head($stats[$week][$dayNum])['sum'];
                }
                $data[] = ['x' => strval($week), 'y' => $stat];
            }
            $series[] = [
                'name' => Str::limit($day, 3, ''),
                'data' => $data
            ];
        }

        return [
            'groups' => $this->getMonths($month),
            'series' => json_encode($series),
            'user' => auth()->user(),
        ];
    }

    public function render()
    {
        return view('gamification.other.heatmap', $this->getData());
    }

    function getMonths($start = null)
    {
        $months = [
            [ 'title' => 'Jan', 'cols' =>  4 ],
            [ 'title' => 'Feb', 'cols' =>  4 ],
            [ 'title' => 'Mar', 'cols' =>  5 ],
            [ 'title' => 'Apr', 'cols' =>  4 ],
            [ 'title' => 'May', 'cols' =>  5 ],
            [ 'title' => 'Jun', 'cols' =>  4 ],
            [ 'title' => 'Jul', 'cols' =>  4 ],
            [ 'title' => 'Aug', 'cols' =>  5 ],
            [ 'title' => 'Sep', 'cols' =>  4 ],
            [ 'title' => 'Oct', 'cols' =>  5 ],
            [ 'title' => 'Nov', 'cols' =>  4 ],
            [ 'title' => 'Dec', 'cols' =>  5 ],
        ];

        if($start) {
            $months = array_slice($months, $start);
        }

        return json_encode($months);
    }

    /**
     * TODO: use this for next version
     */
    function getWeekByMonth($month = 1, $year = null)
    {
        $year = $year ?? Carbon::now()->year;
        $date = Carbon::createFromDate($year, $month);
        $numberOfWeeks = floor($date->daysInMonth / Carbon::DAYS_PER_WEEK);
        $start = $end = [];
    
        $j=1;
        for ($i=1; $i<=$date->daysInMonth; $i++) {
            Carbon::createFromDate($year,$month,$i); 
            $start['Week: '.$j.' Start Date']= (array)Carbon::createFromDate($year,$month,$i)->startOfWeek()->toDateString();
            $end['Week: '.$j.' End Date']= (array)Carbon::createFromDate($year,$month,$i)->endOfweek()->toDateString();
            
            $i+=7; $j++; 
        }
        
        $result = array_merge($start,$end);
        $result['numberOfWeeks'] = ["$numberOfWeeks"];
        
        return $result;
    }

    function getDateByDayWeek($dayOfWeek, $weekNumber)
    {
        return Carbon::now()->setISODate(Carbon::now()->year, $weekNumber, $dayOfWeek);
    }

}
