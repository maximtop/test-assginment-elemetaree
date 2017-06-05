<?php

namespace app\commands;

use yii\console\Controller;
use app\components\WeatherApi;
use Carbon\Carbon;

class WeatherController extends Controller
{
    private $apiDaysLimit = 30;
    public function actionIndex($start_date = null, $end_date = null)
    {
        $end_date = is_null($end_date) ? Carbon::now() : Carbon::parse($end_date);
        $start_date = is_null($start_date) ? $end_date->copy()->subMonths(2) : Carbon::parse($start_date);

        echo $end_date . "\n";
        echo $start_date . "\n";

        while($start_date->diffInDays($end_date, false) > 0) {
            $start_limit = $start_date->copy();
            $start_date = $start_date->addMonth();
            $end_limit = $start_limit->diffInMonths($end_date, false) > 0 ? $start_date : $end_date;
            echo $start_limit . " - " . $end_limit . "\n";
        }
    }
}
