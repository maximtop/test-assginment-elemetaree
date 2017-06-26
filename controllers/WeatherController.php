<?php

namespace app\controllers;

use app\components\Calendar;
use Carbon\Carbon;
use yii\web\Controller;
use app\models\Weather;
use app\models\WeatherSearch;
use Yii;

class WeatherController extends Controller
{
    public function actionIndex()
    {
        $end_date = Carbon::now()->format('Y-m-d');
        $start_date = Carbon::now()->subMonths(2)->format('Y-m-d');
        $days = Weather::find()
            ->where(['between', 'date', $start_date, $end_date])
            ->orderBy('date ASC')
            ->all();
        $calendar = new Calendar();
        $model = new WeatherSearch();
        $days_array = $calendar->prepareDataFromDatabase($days);
        return $this->render('index.twig', [
            'days' => $days_array,
            'model' => $model
        ]);
    }

    public function actionSearch()
    {
        $model = new WeatherSearch();
        $model->search(Yii::$app->request->queryParams);
        $days = Weather::find()
            ->where(['between', 'date', Carbon::parse($model->start_date), $model->end_date])
            ->orderBy('date ASC')
            ->all();
        $calendar = new Calendar();
        $days_array = $calendar->prepareDataFromDatabase($days);
        return $this->render('index.twig', [
            'days' => $days_array,
            'model' => $model
        ]);
    }
}