<?php

use yii\db\Migration;

/**
 * Handles the creation of table `weather`.
 */
class m170605_080439_create_weather_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('weather', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'mintemp' => $this->integer(),
            'maxtemp' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('weather');
    }
}
