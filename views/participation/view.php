<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Participation $model */

$this->title = $model->Event_idEvent;
$this->params['breadcrumbs'][] = ['label' => 'Participations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="participation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Event_idEvent' => $model->Event_idEvent, 'Person_idPerson' => $model->Person_idPerson], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Event_idEvent' => $model->Event_idEvent, 'Person_idPerson' => $model->Person_idPerson], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Event_idEvent',
            'Person_idPerson',
            'time',
            'points',
            'position',
            'note',
        ],
    ]) ?>

</div>
