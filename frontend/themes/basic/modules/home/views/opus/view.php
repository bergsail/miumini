<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\home\models\Opus */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Albums'), 'url' => ['album/index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['album/view','id' =>$model->album_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-view">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
<div class="row">
<!--     <div class="col-md-9">
        <img src="<?= $model->path ?>">
    </div> -->
    <div class="col-md-3"></div>
</div>
