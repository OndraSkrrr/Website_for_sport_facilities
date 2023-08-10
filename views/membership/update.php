<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Membership $model */

$this->title = 'Update Membership: ' . $model->Club_idClub;
$this->params['breadcrumbs'][] = ['label' => 'Memberships', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Club_idClub, 'url' => ['view', 'Club_idClub' => $model->Club_idClub, 'Person_idPerson' => $model->Person_idPerson]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="membership-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
