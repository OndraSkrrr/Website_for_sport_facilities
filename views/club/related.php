<?php

use app\models\Club;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


use app\models\Sport;
use app\models\SportSearch;


/** @var yii\web\View $this */
/** @var app\models\ClubSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clubs';
$this->params['breadcrumbs'][] = $this->title;

$id = $_GET['p1'];
$sport = Sport::find()->andWhere(['idSport' => $id])->one();

?>
<div class="club-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h4> These are clubs in the sport field: <?= Html::encode($sport->name) ?> </h4>
    <h6> You can sign for club by clicking join button. </h6>

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
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',  // the default buttons + your custom button
                'buttons' => [
                    'myButton' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::encode("join!"), ['club/sign', 'clubId' => $model->idClub]);
                    }
                ]
            ],
            
        ],
    ]); ?>


</div>
