<?php
use iisns\webuploader\MultiImage;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\modules\home\models\Album */

$this->title =  Yii::t('app', 'Edit Opus');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Albums'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $model->name ,  'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;


?>


<?= MultiImage::widget(); ?>

<div class="post-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name', [
      'template' => "<div class=\"input-group\"><span class=\"input-group-addon\">" . Yii::t('app', 'Title') . "</span>{input}</div>",
    ])->textInput(['maxlength' => 128, 'autocomplete'=>'off']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
