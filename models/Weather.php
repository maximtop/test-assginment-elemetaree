<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Weather extends ActiveRecord
{
    public static function tableName()
    {
        return 'weather';
    }

    public function rules()
    {
        return [
            [['day', 'maxtemp', 'mintemp'], 'required'],
            [['day'], 'date'],
            [['maxtemp', 'mintemp'], 'integer'],
        ];
    }

}