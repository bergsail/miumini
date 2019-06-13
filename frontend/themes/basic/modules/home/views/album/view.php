<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\LightBoxAsset;
use shiyang\masonry\Masonry;

/* @var $this yii\web\View */
/* @var $model app\modules\home\models\Album */

LightBoxAsset::register($this);

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Albums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="album-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a('<i class="glyphicon glyphicon-edit"></i> ' . Yii::t('app', 'Edit Album'), ['/home/album/update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    <?php if ($model->opusCount == 0 && $model->created_by === Yii::$app->user->id): ?>
        <div class="no-photo">
            <img src="<?= Yii::getAlias('@web/images/no_photo.png') ?>" class="no-picture" alt="No photos">
            <div class="no-photo-msg">                       
                <div><?= Yii::t('app', 'No opus in this album, click "Upload new opus" to make up your album.') ?></div>
                <div class="button">
                    <div class="bigbutton">
                        <a href="<?= Url::toRoute(['/home/album/upload', 'id' => $model->id]) ?>" class="btn btn-default" data-pjax="0">
                            <span class="glyphicon glyphicon-plus"></span> <?= Yii::t('app', 'Upload a new opus') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <a href="<?= Url::toRoute(['/home/opus/create', 'albumId' => $model->id]) ?>" class="btn btn-default" data-pjax="0">
            <span class="glyphicon glyphicon-plus"></span> <?= Yii::t('app', 'Upload a new opus') ?>
        </a>
        <div class="img-all row">
            <?php Masonry::begin([
                'options' => [
                  'id' => 'opuses'
                ],
                'pagination' => $model->opuses['pages']
            ]); ?>
            <!-- <?echo "<pre>";var_dump($model->opuses);echo "</pre>";?> -->
            <?php foreach ($model->opuses['opuses'] as $opus): ?>

                <div class="img-item col-md-3" id="<?= $opus['id'] ?>">
                    <div class="img-wrap">
                        <div class="img-edit">
                            <a href="<?= Url::toRoute(['/home/opus/delete', 'id' => $opus['id']]) ?>" data-clicklog="delete" onclick="return false;" title="<?= Yii::t('app', 'Are you sure to delete it?') ?>">
                                <span class="img-tip"><i class="glyphicon glyphicon-remove"></i></span>
                            </a>
                        </div>
                        <div class="img-main">
                            <a title="<?= Html::encode($opus['name']) ?>" href="<?= $opus['path']?>" data-lightbox="image-1" data-title="<?= Html::encode($opus['name']) ?>">
                                <img src="<?= $opus['path'] ?>"> 
                            </a>
                            <div class="img-name"><?= Html::encode($opus['name']) ?></div> 
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <?php Masonry::end(); ?>
        </div>
    <?php endif ?>
</div>
