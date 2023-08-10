<?php
use yii\helpers\html;
?>

<div>You have been signed to a club. To return to previous page click link below. </div>

<?= Html::a(Html::encode("Go back!"), ['sport/all',]) ?>