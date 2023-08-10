<?php

use app\models\Event;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\EventSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'private Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h6>Here you can see all the private events in the area, that are related to your sports (sport that you practice as a member of a club). By clicking go button, you will sign for the event.</h6>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idEvent',
            'name',
            'time',
            'private',
            'Club_idClub',

            'idSport',

            //'Location_idLocation',
            //'address',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',  // custom button
                'buttons' => [
                    'myButton' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::encode("go!"), ['event/join', 'eventId' => $model['idEvent']]);
                    }
                ]
            ],


            //tohle jsou ty cudliky - action column
            //[
            //    'class' => ActionColumn::className(),
            //   'urlCreator' => function ($action, Event $model, $key, $index, $column) {
            //        return Url::toRoute([$action, 'idEvent' => $model->idEvent]);
            //     }
            //],
        ],
    ]); ?>


</div>