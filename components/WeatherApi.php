<?php

namespace app\components;

use yii\helpers\Json;
use yii\httpclient\Client;

class WeatherApi
{
    private $api_key = '';
    public $city = 'Moscow';
    public $base_url = 'http://api.worldweatheronline.com/premium/v1/past-weather.ashx';
    public $time_period = '24';
    public $format = 'json';

    public function getWeatherHistory($start_date, $end_date)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($this->base_url)
            ->setData([
                'key' => $this->api_key,
                'q' => $this->city,
                'format' => $this->format,
                'date' => $start_date,
                'enddate' => $end_date,
                'tp' => $this->time_period
            ])
            ->send();
        return Json::decode($response->content);
    }
}