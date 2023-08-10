<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Person $model */

$this->title = 'Fill in your personal information to create your account.';
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_quest', [
        'model' => $model,
    ]) ?>

</div>
