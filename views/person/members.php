<?php

use app\models\Person;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

use app\models\Club;
use app\models\ClubSearch;

/** @var yii\web\View $this */
/** @var app\models\PersonSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'People';
$this->params['breadcrumbs'][] = $this->title;

$id = $_GET['idClub'];
$club = Club::find()->andWhere(['idClub' => $id])->one();

?>
<div class="person-index">


    <h1><?= Html::encode($club->name) ?></h1>
    <h6><?= Html::encode("These are members of the club.") ?></h6>
    <h6> To see participations of the member click view button. </h6>
    


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPerson',
            'name',
            'surname',
            'email:email',
            'phone',
            //'personal_number',
            //'password',
            //'user_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',  // custom button
                'buttons' => [
                    'myButton' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::encode("view!"), ['participation/attend', 'idPerson' => $model->idPerson]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
