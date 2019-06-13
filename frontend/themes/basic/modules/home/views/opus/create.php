<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\home\models\Album */

$this->title = Yii::t('app', 'Create Opus');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Albums'), 'url' => ['album/index']];
$this->params['breadcrumbs'][] = ['label' => $album->name, 'url' => ['album/view','id' =>$album->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="opus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
