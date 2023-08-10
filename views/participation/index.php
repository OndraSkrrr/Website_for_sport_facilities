<?php

use app\models\Participation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ParticipationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Participations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Participation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Event_idEvent',
            'Person_idPerson',
            'time',
            'points',
            'position',
            //'note',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Participation $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Event_idEvent' => $model->Event_idEvent, 'Person_idPerson' => $model->Person_idPerson]);
                 }
            ],
        ],
    ]); ?>


</div>
