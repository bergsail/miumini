<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use app\themes\basic\modules\home\CreationeditAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

CreationeditAsset::register($this);

?>
<?php $this->beginPage() ?>

    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="<?= Yii::getAlias('@web') ?>/favicon.ico">
        <?php $this->head() ?>
    </head>

    <body>
     <?php $this->beginBody() ?> 
      <div id ="creation-wrap">
        <div id="creation-topnav">
            <div id="btn-group-create-type">
               <div id="btn-creation-post" class = "btn-create-type btn-create-type-active">
                    <?= Html::label('文 章', ['/'], ['class' => 'btn-creation']) ?>
               </div>
               <div id="btn-creation-tune" class = "btn-create-type">
                    <?= Html::label('音 频', ['/'], ['class' => 'btn-creation']) ?>
               </div>
               <div id="btn-creation-opus" class = "btn-create-type">
                    <?= Html::label('乐 谱', ['/'], ['class' => 'btn-creation']) ?>
               </div>
            </div>
            <div id="btn-group-create-action">
               <div id="btn-creation-preview" class="btn-create-action">
                   <a class="btn-creation" 
                      href="<?= Url::toRoute(['/home/creation/view', 'id' => $this->params['id']]) ?>" 
                      target="_blank">
                      预 览
                   </a>
               </div>
               <div id="btn-creation-create" class="btn-create-action">
                   <!-- <?= Html::a('发 布', ['/'], ['class' => 'btn-creation']) ?> -->
                   <a class="btn-creation" 
                      href="<?= Url::toRoute(['/user/dashboard']) ?>" 
                      >
                      发 布
                   </a>
               </div>
            </div>
       </div>
       <div class="container">
          <?= $content ?>
       </div>
      
    </div>

    <div style="display: none"><?= Yii::$app->setting->get('statisticsCode') ?></div>

        <div class="pt-message">
            <p>亲，你的浏览器不支持 CSS 动画，请使用 Chrome,Firefox,Safari 等浏览器浏览.</p>
        </div>
     <?php $this->endBody() ?>

    </body>

    </html>

<?php $this->endPage() ?>
