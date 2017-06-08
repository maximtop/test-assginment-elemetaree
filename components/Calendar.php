<?php

namespace app\components;

use Carbon\Carbon;

class Calendar
{

    public function createCalendar($date = null)
    {
        $daysOfWeek = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
        $date = is_null($date) ? Carbon::now() : Carbon::parse($date);
        $month = $date->month;
        $firstDayOfMonth = $date->startOfMonth();
        $dayOfWeek = $firstDayOfMonth->dayOfWeek;
        $table = "<table class='table table-bordered'><thead><tr><th colspan='8' class='text-center'>{$date->format('F')}</th></tr><tr><th>Week</th>" . array_reduce($daysOfWeek,
                function($acc, $item) {return $acc .= "<th>{$item}</th>";}, "") ."</tr></thead>";
        $table .= "<tbody><td>{$date->format('W')}</td>";
        for($i = 0; $i < $dayOfWeek - 1; $i++) {
            $table .= "<td></td>";
        }
        while ($date->month == $month) {
            $table .= "<td>{$date->format('j M')}</td>";
            if($date->dayOfWeek % 7 == 0) {
                $table .= "</tr><tr><td>" . ($date->format('W') + 1) . "</td>";
            }
            $date->addDay();
        }
        for($i = $date->dayOfWeek; $i <= 7; $i++) {
            $table .= "<td></td>";
        }
        return $table . '</tbody></table>';
    }

    public function createCalendarFromData(array $days = null)
    {
        $days_array = [];
        foreach ($days as $day) {
            $date = Carbon::parse($day->date);
            $maxtemp = $day->maxtemp;
            $mintemp = $day->mintemp;
            $days_array[$date->year][$date->month][$date->day] = [
                'date' => $date->toDateString(),
                'maxtemp' => $maxtemp,
                'mintemp' => $mintemp,
                'range' => abs($maxtemp - $mintemp)
                ];
        }
        foreach ($days_array as $year => $months) {
            foreach ($months as $month => $days) {
                $max_range = max(array_column($days, 'range'));
                $avg_range = array_sum(array_column($days, 'range')) / count($days);
                foreach ($days as $date => $day) {
                    if($day['range'] == $max_range) {
                        $days_array[$year][$month][$date]['class'] = 'max-range';
                    } else if ($day['range'] >= $avg_range) {
                        $days_array[$year][$month][$date]['class'] = 'avg-range';
                    }
                }
            }
        }
        return $days_array;

    }

//    public function createCalendar($date = null)
//    {
//        $daysOfWeek = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
//        $date = is_null($date) ? Carbon::now() : Carbon::parse($date);
//        $month = $date->month;
//        $firstDayOfMonth = $date->startOfMonth();
//        $dayOfWeek = $firstDayOfMonth->dayOfWeek;
//        $table = "<table class='table table-bordered'><thead><tr><th colspan='8' class='text-center'>{$date->format('F')}</th></tr><tr><th>Week</th>" . array_reduce($daysOfWeek,
//                function($acc, $item) {return $acc .= "<th>{$item}</th>";}, "") ."</tr></thead>";
//        $table .= "<tbody><td>{$date->format('W')}</td>";
//        for($i = 0; $i < $dayOfWeek - 1; $i++) {
//            $table .= "<td></td>";
//        }
//        while ($date->month == $month) {
//            $table .= "<td>{$date->format('j M')}</td>";
//            if($date->dayOfWeek % 7 == 0) {
//                $table .= "</tr><tr><td>" . ($date->format('W') + 1) . "</td>";
//            }
//            $date->addDay();
//        }
//        for($i = $date->dayOfWeek; $i <= 7; $i++) {
//            $table .= "<td></td>";
//        }
//        return $table . '</tbody></table>';
//    }
}


