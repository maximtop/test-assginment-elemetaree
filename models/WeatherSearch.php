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
    public $date_range;
    public function rules()
    {
        return [
            [['start_date', 'end_date'], 'default', 'value' => null],
            [['start_date', 'end_date'], 'date'],
        ];
    }

//    public function scenarios()
//    {
//       return Model::scenarios();
//    }

//    public function search($params)
//    {
//        $query = Weather::find();
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//
//        $this->load($params);
//
//        if (!$this->validate()) {
//            return $dataProvider;
//        }
//
//        $query->andFilterWhere([
//            'population' => $this->population,
//        ]);
//
//        $query->andFilterWhere(['like', 'code', $this->code])
//            ->andFilterWhere(['like', 'name', $this->name]);
//
//        return $dataProvider;
//    }
}
