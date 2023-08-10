<?php
use yii\helpers\html;
?>

<div>You dissmised the event. To return click link below. </div>

<?= Html::a(Html::encode("Go back!"), ['site/index',]) ?>