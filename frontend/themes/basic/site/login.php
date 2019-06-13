<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'Log in');

$this->registerCss('
    body {
      background-color: #eef0f3;
    }
    .form-login {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }
    .logo img {
      max-width: 100%;
    }
    #form-logup .form-signin-heading,
    #form-logup .checkbox {
      margin-bottom: 10px;
    }
    #form-logup .checkbox {
      font-weight: normal;
    }
    #form-logup .form-control {
      position: relative;
      height: auto;
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
      padding: 10px;
      font-size: 16px;
    }
    #form-logup .form-control:focus {
      z-index: 2;
    }
    #form-logup input[type="text"] {
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    #form-logup input[type="password"] {
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }


#form-login {
  max-width: 640px;
  margin-top: 50px;
}

#form-signin {
  max-width: 640px;
  margin-top:50px;
}

.logo {
  height:50%;
}

.logo h2 {
  font-size: 50px;
  text-align: center;
  padding:30px;
  color: #c1b561
}

.vm-slogan {
  display: block;
}

.vm-form-dash-line {

  
  display: inline-block;
  width: 165px;
  height:8px;
  margin-left:10px;
  margin-right:10px;
  border-top: 1px dashed #c1b561;
}

.vm-form-dot {
  display: inline;
}

.vm-form-dot {
    background-image: url("http://staticwebpage.bj.bcebos.com/public/bg.png");
    background-repeat: no-repeat;
    _background-image: url("http://staticwebpage.bj.bcebos.com/public/bg_ie6.png");
    width: 16px;
    height: 16px;
    vertical-align: 1px;
    margin-left: 6px;
    background-position: -72px -216px ;
}

@media screen and (-webkit-min-device-pixel-ratio: 2), not all {
  .vm-form-dot {
    background-image: url("http://staticwebpage.bj.bcebos.com/public/bg_retina.png")!important;
    background-size: 310px 432px!important;
  }
}

.logo .vm-form-slogan  {
  display: inline;
  font-size: 25px;
  text-align: center;
  color: #c1b561

}

#form-signup {
  /*text-align: center;*/
  margin:auto;
  margin-top: 50px;
  width:320px;
}

#form-logup {
  margin:auto;
  margin-top: 50px;
  width:320px;
}


.input-group {
  width: 100%;
  padding: 0px;
  margin-top: 28px;
}

#form-signup button {
  width:100%;
  margin-top: 28px;
}

#form-logup button {
  width:100%;
  margin-top: 28px;
}

.has-success .form-control {
    border-color: #c1b561!important;
}


.has-success .form-control:focus {
  box-shadow: 0 1px 1px rgba(0,0,0,0.75) inset, 0 0 6px #c1b561!important;
}
.has-error .form-control {
    border-color: #bbbbbb!important;
}
.help-block-error {
  color:#bbbbbb!important;
}

input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill {
    background-color: rgb(255, 255, 245)!important;
    background-image: none;
    color: rgb(0, 0, 0);
}


');
?>



<div class="form-login" id = "form-login">
  <div class="logo">
      <h2> 微 &nbsp 米 </h2>
      <div class = "vm-slogan">
         <a class = "vm-form-dash-line"></a>
         <a class = "vm-form-slogan">臻于至精</a>
         
         <a class = "vm-form-dot">&nbsp&nbsp&nbsp&nbsp</a>

          <a class = "vm-form-slogan">洞悉底蕴</a>

         <a class = "vm-form-dash-line"></a>
      </div>

      <!-- <img src="<?= Yii::getAlias('@web') ?>/images/logo.png"> -->
  </div>
<?php $form = ActiveForm::begin([
    'id' => 'form-logup',
]); ?>
  <?= $form->field($model, 'username', [
      'template' => '<div class="input-group">{input}</div>{error}',
      'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('username'),
      ],
    ])->label(false);
  ?>
  <?= $form->field($model, 'password', [
      'template' => '<div class="input-group">{input}</div>{error}',
      'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('password'),
      ],
    ])->passwordInput()->label(false);
  ?>
  <?= $form->field($model, 'rememberMe')->checkbox() ?>
  <div style="color:#999;margin:1em 0">
      <?= Yii::t('app', 'If you forgot your password you can ') . Html::a(Yii::t('app', 'reset it'), ['site/request-password-reset']) ?>.
  </div>
  <div class="form-group">
      <?= Html::submitButton(Yii::t('app', 'Log in'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
  </div>
<?php ActiveForm::end(); ?>
</div>
