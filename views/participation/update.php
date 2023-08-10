<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Participation $model */

$this->title = 'Update Participation: ' . $model->Event_idEvent;
$this->params['breadcrumbs'][] = ['label' => 'Participations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Event_idEvent, 'url' => ['view', 'Event_idEvent' => $model->Event_idEvent, 'Person_idPerson' => $model->Person_idPerson]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="participation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
