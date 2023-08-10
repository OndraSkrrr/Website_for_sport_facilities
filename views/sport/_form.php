<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Sport $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sport-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idSport')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
