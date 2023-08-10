<?php

use app\models\Sport;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/** @var yii\web\View $this */
/** @var app\models\SportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sports';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="sport-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h6>Here you can see all the sports in area. By clicking on the sport you will see the clubs related to that sport.</h6>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget( [
    'dataProvider' => $dataProvider,
    'itemView' => '_items',
    'viewParams' => [
    'fullView' => true,
    'context' => 'main-page'],
    ] ); ?>

</div>
