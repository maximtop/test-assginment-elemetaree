<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

?>

<div class="country-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'start_date')->widget(DatePicker::classname(), [
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>
    <?= $form->field($model, 'end_date')->widget(DatePicker::classname(), [
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Get weather data', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<!-- TODO find out how to use date range picker -->

