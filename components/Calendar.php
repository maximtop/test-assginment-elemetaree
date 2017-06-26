<?php

namespace app\components;

use Carbon\Carbon;

class Calendar
{
    public function prepareDataFromDatabase(array $days = null)
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
        $days_array_with_ranges = $this->calculateTempRanges($days_array);
        $full_months = $this->getFullMonths($days_array_with_ranges);
        return $full_months;
    }

    public function calculateTempRanges($days_array)
    {
        foreach ($days_array as $year => $months) {
            foreach ($months as $month => $days) {
                $max_range = max(array_column($days, 'range'));
                $avg_range = array_sum(array_column($days, 'range')) / count($days);
                foreach ($days as $date => $day) {
                    if ($day['range'] == $max_range) {
                        $days_array[$year][$month][$date]['class'] = 'max-range';
                    } else {
                        if ($day['range'] >= $avg_range) {
                            $days_array[$year][$month][$date]['class'] = 'avg-range';
                        }
                    }
                }
            }
        }
        return $days_array;
    }

    public function getFullMonths($days_array)
    {
        foreach ($days_array as $year => $months) {
            foreach ($months as $month => $days) {
                $monthDay = Carbon::create($year, $month, 1);
                while($monthDay->month == $month) {
                    $day = $monthDay->day;
                    if(isset($days[$day])) {
                        $days_array[$year][$month][$day] = $days[$day];
                    } else {
                        $days_array[$year][$month][$day] = [
                            'date' => $monthDay->toDateString()
                        ];
                    }
                    $monthDay->addDay();
                }
                ksort($days_array[$year][$month]);
            }
        }
        return $days_array;
    }
}