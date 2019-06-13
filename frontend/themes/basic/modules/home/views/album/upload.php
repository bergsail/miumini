<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\home\models\Post */

?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <!-- <?echo "<pre>";var_dump($model);echo "</pre>";?> -->
    <?= $this->render('_formOpus', [
        'model' => $model,
    ]) ?>

</div>
