<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\home\models\Album */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="opus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'player')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'author')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'work_identity')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'work_key')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'work_movement')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'work_birth')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'work_production')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'work_tperiod')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'work_style')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'work_instrument')->textInput(['maxlength' => 128]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
