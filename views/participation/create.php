<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Participation $model */

$this->title = 'Create Participation';
$this->params['breadcrumbs'][] = ['label' => 'Participations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
