<?php

use app\models\Membership;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MembershipSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Memberships';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membership-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Membership', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Club_idClub',
            'Person_idPerson',
            'Coach',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Membership $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Club_idClub' => $model->Club_idClub, 'Person_idPerson' => $model->Person_idPerson]);
                 }
            ],
        ],
    ]); ?>


</div>
