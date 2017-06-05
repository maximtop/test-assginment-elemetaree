<?php

namespace app\components;

use yii\httpclient\Client;


class WeatherApi
{
    public $city = 'Moscow';
    public $base_url = 'http://api.worldweatheronline.com/premium/v1/past-weather.ashx';
    public $start_date = '2016-01-01';
    public $end_date = '2016-02-01';
    public $time_period = '1';
    private $api_key = 'bff763fcb9304d4b992152328170406';
    public $format = 'json';

    public function getWeatherHistory()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($this->base_url)
            ->setData([
                'key' => $this->api_key,
                'q' => $this->city,
                'format' => $this->format,
                'date' => $this->start_date,
                'enddate' => $this->end_date,
                'tp' => $this->time_period
            ])
            ->send();
        return $response;
    }
}