<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\LightBoxAsset;
use shiyang\masonry\Masonry;

/* @var $this yii\web\View */
/* @var $model app\modules\home\models\Album */

LightBoxAsset::register($this);

$this->title = $model->name;
$this->params['user'] = $user;
$this->params['profile'] = $user->profile;
$this->params['userData'] = $user->userData;
?>

<div class="album-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if ($model->opusCount == 0 && $model->created_by === Yii::$app->user->id): ?>
        <div class="no-photo">
            <img src="<?= Yii::getAlias('@web/images/no_photo.png') ?>" class="no-picture" alt="No photos">
            <div class="no-photo-msg">                       
                <div><?= Yii::t('app', 'No opus in this album, click "Upload new opus" to make up your album.') ?></div>
                <div class="button">
                    <div class="bigbutton">
                        <a href="<?= Url::toRoute(['/home/album/upload', 'id' => $model->id]) ?>" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus"></span> <?= Yii::t('app', 'Upload a new opus') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="img-all row">
            <?php Masonry::begin([
                'options' => [
                  'id' => 'opuses'
                ],
                'pagination' => $model->opuses['pages']
            ]); ?>
            <?php foreach ($model->opuses['opuses'] as $opus): ?>
                <div class="img-item col-md-6" id="<?= $opus['id'] ?>">
                    <div class="img-wrap">
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
