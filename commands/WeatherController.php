<?php

namespace app\commands;

use app\models\Weather;
use yii\console\Controller;
use app\components\WeatherApi;
use Carbon\Carbon;
use yii\helpers\Json;
use \Yii;

class WeatherController extends Controller
{
    public function actionIndex($start_date = null, $end_date = null)
    {
        $end_date = is_null($end_date) ? Carbon::now() : Carbon::parse($end_date);
        $start_date = is_null($start_date) ? $end_date->copy()->subMonths(2) : Carbon::parse($start_date);

        echo $end_date . "\n";
        echo $start_date . "\n";
        $weather_history_arr = [];

        while ($start_date->diffInDays($end_date, false) > 0) {
            $start_limit = $start_date->copy();
            $start_date = $start_date->addMonth();
            $end_limit = $start_limit->diffInMonths($end_date, false) > 0 ? $start_date : $end_date;
            $weather = new WeatherApi();
            $weather_history = $weather->getWeatherHistory($start_limit->toDateString(), $end_limit->toDateString());
//            file_put_contents('weather_array.php', var_export($weather_history, TRUE));

            foreach ($weather_history['data']['weather'] as $day) {
                array_push($weather_history_arr, [$day['date'], $day['maxtempC'], $day['mintempC']]);
            };

        }
        print_r($weather_history_arr);
        Yii::$app->db
            ->createCommand()
            ->batchInsert('weather',
                ['date', 'maxtemp', 'mintemp'],
                $weather_history_arr)
            ->execute();
        echo 'done!';
    }
}
