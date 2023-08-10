<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Membership $model */

$this->title = $model->Club_idClub;
$this->params['breadcrumbs'][] = ['label' => 'Memberships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="membership-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Club_idClub' => $model->Club_idClub, 'Person_idPerson' => $model->Person_idPerson], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Club_idClub' => $model->Club_idClub, 'Person_idPerson' => $model->Person_idPerson], [
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
            'Club_idClub',
            'Person_idPerson',
            'Coach',
        ],
    ]) ?>

</div>
