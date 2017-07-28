<?php

namespace app\commands;

use yii\console\Controller;
use app\components\WeatherApi;
use Carbon\Carbon;
use \Yii;

class WeatherController extends Controller
{
    public function actionIndex($city = null, $start_date = null, $end_date = null)
    {
        $end_date = is_null($end_date) ? Carbon::now() : Carbon::parse($end_date);
        $start_date = is_null($start_date) ? $end_date->copy()->subYears(2) : Carbon::parse($start_date);
        $city = $city ?? 'Moscow';

        echo "Getting history weather data in the period:
                from {$start_date}
                to {$end_date} \n";
        $weather_history_arr = [];

        while ($start_date->diffInDays($end_date, false) > 0) {
            $start_limit = $start_date->copy();
            $start_date = $start_date->addMonth();
            $end_limit = $start_limit->diffInMonths($end_date, false) > 0 ? $start_date : $end_date;
            $weather = new WeatherApi();
            $weather_history = $weather->getWeatherHistory($city, $start_limit->toDateString(), $end_limit->toDateString());
            $city_name_response = $weather_history['data']['request'][0]['query'];

            foreach ($weather_history['data']['weather'] as $day) {
                $weather_history_arr[$day['date']] = [
                    'date' => $day['date'],
                    'maxtemp' => $day['maxtempC'],
                    'mintemp' => $day['mintempC'],
                    'city' => $city_name_response,
                ];
            };
        }
        Yii::$app->db
            ->createCommand()
            ->batchInsert('weather',
                ['date', 'maxtemp', 'mintemp', 'city'],
                $weather_history_arr)
            ->execute();
        echo "done!";
    }
}
