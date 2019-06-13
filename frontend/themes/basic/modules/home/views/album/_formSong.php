<?php
use iisns\webuploader\MultiImage;

/* @var $this yii\web\View */
/* @var $model app\modules\home\models\Album */

$this->title =  Yii::t('app', 'Edit Song');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Albums'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $model->name ,  'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;


?>


<?= MultiImage::widget(); ?>