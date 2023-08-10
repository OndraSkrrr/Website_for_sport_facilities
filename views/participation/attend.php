<?php

use app\models\Participation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


use app\models\Person;
use app\models\PersonSearch;


/** @var yii\web\View $this */
/** @var app\models\ParticipationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Participations';
$this->params['breadcrumbs'][] = $this->title;

$id = $_GET['idPerson'];
$person = Person::find()->andWhere(['idPerson' => $id])->one();

?>
<div class="participation-index">


    <h1><?= Html::encode("These are participations of the Person:") ?></h1>

    <h1><?= Html::encode($person->name) ?></h1>


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
            'name'
            //'note',
            //[
            //    'class' => ActionColumn::className(),
            //    'urlCreator' => function ($action, Participation $model, $key, $index, $column) {
            //        return Url::toRoute([$action, 'Event_idEvent' => $model->Event_idEvent, 'Person_idPerson' => $model->Person_idPerson]);
            //     }
            //],
        ],
    ]); ?>


</div>
