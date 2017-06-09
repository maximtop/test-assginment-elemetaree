<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Weather;

class WeatherSearch extends Weather
{
    public $start_date;
    public $end_date;
    public function rules()
    {
        return [
            [['start_date', 'end_date'], 'default', 'value' => null],
            [['start_date', 'end_date'], 'date'],
        ];
    }
}
