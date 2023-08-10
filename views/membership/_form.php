<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Membership $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="membership-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Club_idClub')->textInput() ?>

    <?= $form->field($model, 'Person_idPerson')->textInput() ?>

    <?= $form->field($model, 'Coach')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
