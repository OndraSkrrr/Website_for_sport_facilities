<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ParticipationSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="participation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Event_idEvent') ?>

    <?= $form->field($model, 'Person_idPerson') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'points') ?>

    <?= $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
