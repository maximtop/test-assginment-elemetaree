<?php

namespace app\commands;

use yii\console\Controller;
use app\components\WeatherApi;
use Carbon\Carbon;
use \Yii;

class WeatherController extends Controller
{
    public function actionIndex($start_date = null, $end_date = null)
    {
        $end_date = is_null($end_date) ? Carbon::now() : Carbon::parse($end_date);
        $start_date = is_null($start_date) ? $end_date->copy()->subYears(2) : Carbon::parse($start_date);

        echo $end_date . "\n";
        echo $start_date . "\n";
        $weather_history_arr = [];

        while ($start_date->diffInDays($end_date, false) > 0) {
            $start_limit = $start_date->copy();
            $start_date = $start_date->addMonth();
            $end_limit = $start_limit->diffInMonths($end_date, false) > 0 ? $start_date : $end_date;
            $weather = new WeatherApi();
            $weather_history = $weather->getWeatherHistory($start_limit->toDateString(), $end_limit->toDateString());
            foreach ($weather_history['data']['weather'] as $day) {
                $weather_history_arr[$day['date']] = [
                    'date' => $day['date'],
                    'maxtemp' => $day['maxtempC'],
                    'mintemp' => $day['mintempC']
                ];
            };
        }
        Yii::$app->db
            ->createCommand()
            ->batchInsert('weather',
                ['date', 'maxtemp', 'mintemp'],
                $weather_history_arr)
            ->execute();
        echo 'done!';
    }
}
