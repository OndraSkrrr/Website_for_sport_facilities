<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Sport $model */

$this->title = 'Update Sport: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'idSport' => $model->idSport]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sport-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
