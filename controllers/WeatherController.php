<?php

namespace app\controllers;

use app\components\Calendar;
use Carbon\Carbon;
use yii\web\Controller;
use app\components\WeatherApi;
use app\models\Weather;
use app\models\WeatherSearch;

class WeatherController extends Controller
{
    public function actionIndex()
    {
        $days = Weather::find()
            ->where(['between','date',  '2016-12-15', '2017-01-15'])
            ->all();
        $calendar = new Calendar();
        $model = new WeatherSearch();
        $days_array = $calendar->createCalendarFromData($days);
        return $this->render('index.twig', [
            'days' => $days_array,
            'model' => $model
        ]);
    }

    public function actionSearch()
    {
        $calendar = new Calendar();
        $model = new WeatherSearch();
        echo $model->start_date;
        var_dump($model);
//        echo $model->start_date;
        $days = Weather::find()
            ->where(['between','date',  '2016-12-01', '2017-01-15'])
            ->all();
        $days_array = $calendar->createCalendarFromData($days);
        return $this->render('index.twig', [
            'days' => $days_array,
            'model' => $model
        ]);
    }

//    public function actionSearch($from = null, $to = null)
//    {
////        $to = is_null($to) ? Carbon::now() : Carbon::parse($to);
////        $from = is_null($from) ? $to->subMonths(2) : Carbon::parse($from);
//
//        $days = Weather::find()->all();
//        $model = new WeatherSearch();
//        return $this->render('index', [
//            'days' => $days,
//            'model' => $model
//        ]);
//    }
}