<?php

namespace app\models;

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

    public function attributeLabels()
    {
        return [
            'start_date' => 'Start Date:',
            'end_date' => 'End Date:',
        ];
    }

    public function search($params)
    {
        $this->load($params);
    }
}
