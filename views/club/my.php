<?php

use app\models\Club;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ClubSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clubs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="club-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h6>Here you can see clubs that you are member of. You can leave the club by clicking leave button</h6>
    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idClub',
            'name',
            'Sport_idSport',
            'web',
            'email:email',
            //'phone',
            //'address',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',  // custom button
                'buttons' => [
                    'myButton' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::encode("leave!"), ['club/leave', 'clubId' => $model->idClub]);
                    }
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',  // custom button
                'buttons' => [
                    'myButton' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::encode("see mebers!"), ['person/members', 'idClub' => $model->idClub]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
