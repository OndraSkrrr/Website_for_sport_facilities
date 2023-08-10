<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Participation $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="participation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Event_idEvent')->textInput() ?>

    <?= $form->field($model, 'Person_idPerson')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'points')->textInput() ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
