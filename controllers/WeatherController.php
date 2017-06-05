<?php

namespace app\controllers;

use yii\web\Controller;
use app\components\WeatherApi;
use app\models\Weather;
use app\models\WeatherSearch;

class WeatherController extends Controller
{
    public function actionIndex()
    {
        $model = new WeatherSearch();
        return $this->render('index', ['model' => $model]);
    }
}