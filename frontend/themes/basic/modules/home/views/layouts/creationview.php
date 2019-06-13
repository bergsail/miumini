<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\themes\basic\modules\home\CreationviewAsset;
use frontend\widgets\Alert;

CreationviewAsset::register($this);

if (Yii::$app->user->isGuest) {
    $this->beginContent(__DIR__.'/../../../../layouts/basic.php');
} else {
    $this->beginContent('@app/modules/user/views/layouts/user.php');
    $this->registerCssFile('@web/css/site.css');

}
$this->registerMetaTag(['name' => 'keywords', 'content' => Yii::$app->setting->get('siteKeyword')]);
$this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->setting->get('siteDescription')]);
$this->registerCss('
    .wrap {background-color: rgba(255,255,255,0.01);}
');
/* @var $this \yii\web\View */
/* @var $content string */

?>

<div class="wrap">

    <div id = "explore-container" <?= (Yii::$app->user->isGuest) ? 'class="container"' : 'style="padding: 0 0px;"' ?> >
        <?= $content; ?>
    </div>
    <?php if (Yii::$app->user->isGuest): ?>
        <footer class="footer">
           <div class="container">
              <p class="pull-left">&copy; <?= Html::a(Yii::$app->setting->get('siteName'), ['/site/index']) ?> <?= date('Y') ?>
                  <?= Html::a (' 中文简体 ', '?lang=zh-CN') . '| ' . Html::a (' English ', '?lang=en'); ?>
              </p>
           </div>
        </footer>
    <?php endif; ?>
</div>


<?php $this->endContent(); ?>