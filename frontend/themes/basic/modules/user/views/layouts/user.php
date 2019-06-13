<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;
use app\themes\basic\modules\user\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $user string */

$user = Yii::$app->user->identity;
$unReadMessageCount = $user->unReadMessageCount;

AppAsset::register($this);
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
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?= Yii::getAlias('@web') ?>/favicon.ico">
</head>
<body style="width:1050px; margin:auto">
    <?php $this->beginBody() ?>
    <div id="wrapper" class = "sidebar-hide">
        <header id="top-nav" class="fixed skin-1">

            <ul class="nav-notification clearfix">
                <li class="dropdown" id="notificationring">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="glyphicon glyphicon-bell"></i>
                        <span class="badge badge-danger notification-label bounceIn animation-delay4"><?= $unReadMessageCount  ?></span>
                    </a>
                    <ul class="dropdown-menu message dropdown-1">
                        <li><a>You have <?= $unReadMessageCount ?> new unread messages</a></li>
                        <li><a href="<?= Url::toRoute(['/user/message']) ?>">View all messages</a></li>
                    </ul>
                </li>
                <li class="profile dropdown" id="notificationuser">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img src="<?= Yii::getAlias('@avatar'). $user->avatar ?>" alt="User Avatar">
                    </a>
                    <ul class="dropdown-menu">

                        <li>
                            <a tabindex="-1" href="<?= Url::toRoute(['/home/creation/create']) ?>" class="main-link" data-pjax="0">
                                <i class="glyphicon glyphicon-edit"></i> 
                                <?=Yii::t('app','Creation')?>
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a tabindex="-1" href="<?= Url::toRoute('/user/dashboard') ?>" class="main-link" >
                                <i class="glyphicon glyphicon-time"></i>
                                <?= Yii::t('app', 'Musicians Space') ?>
                            </a>
                        </li>
<!--                         <li>
                            <a tabindex="-1" href="<?= Url::toRoute('/home/post') ?>" class="main-link" >
                                <i class="glyphicon glyphicon-list-alt"></i>
                                <?= Yii::t('app', 'Blog') ?>
                            </a>
                        </li>
                        <li>
                            <a tavindex="-1" href="<?= Url::toRoute('/home/album') ?>" class="main-link">
                            <i class="glyphicon glyphicon-picture"></i>
                                <?= Yii::t('app', 'Album') ?>
                        </li>
 -->
                        <li class="divider"></li>

                        <li>
                            <a tabindex="-1" href="<?= Url::toRoute(['/user/view/index', 'id'=>$user['username']]) ?>" class="theme-setting">
                                <i class="glyphicon glyphicon-user"></i> 
                                <?= Yii::t('app', 'Personal Center') ?>
                            </a>
                        </li>
                        <li>
                            <a tabindex="-1" href="<?= Url::toRoute(['/user/setting']) ?>" class="theme-setting">
                                <i class="glyphicon glyphicon-cog"></i> 
                                <?= Yii::t('app', 'Setting') ?>
                            </a>
                        </li>
                        <li>
                            <a tabindex="-1" class="main-link" data-toggle="modal" data-target="#logoutConfirm">
                                <i class="glyphicon glyphicon-log-out"></i> 
                                <?= Yii::t('app', 'Log out') ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>

        <?php \yii\widgets\Pjax::begin(['linkSelector' => 'a']) ?>

        <div id="main-container">
            <div class="padding-md">
                <?= Alert::widget() ?>
               <!--  <div class="wrap"> -->
                    <header id="header" class="hidden-xs">
                         <?php
                   
                                NavBar::begin([
                                    'brandLabel' => '<img src="http://staticwebpage.bj.bcebos.com/temp/logo.png" style="display:inline; margin-top: 0;vertical-align: middle; height:50px;"> 微 米  ',
                                    'brandUrl' => Yii::$app->homeUrl,
                                    'options' => [
                                       'id' => 'logo-wrapper',
                                       'class' => 'navbar-default',
                                    ],
                                ]);
                                if (Yii::$app->user->isGuest) {
                                    $menuItems[] = ['label' => '<i class="glyphicon glyphicon-plus-sign"></i> ' . Yii::t('app', 'Sign up'), 'url' => ['/site/signup']];
                                    $menuItems[] = ['label' => '<i class="glyphicon glyphicon-log-in"></i> ' . Yii::t('app', 'Log in'), 'url' => ['/site/login']];
                               
                                    echo Nav::widget([
                                       'options' => ['id' => 'user-nav', 'class' => 'navbar-nav navbar-right'],
                                       'encodeLabels' => false,
                                       'items' => $menuItems,
                                    ]);
                                } else {

                                }
                              
                                NavBar::end();
                     
                        ?> 

                    </header>

                <!-- </div> -->
                <?= $content ?>
            </div>
        </div>
        <?php \yii\widgets\Pjax::end() ?>

    </div>
    <?php
      Modal::begin([
          'id' => 'logoutConfirm',
          'header' => '<h2>' . Yii::t('app', 'Log out') . '</h2>',
          'footer' => Html::a(Yii::t('app', 'Log out'), ['/site/logout'], ['class' => 'btn btn-default'])
      ]);
      echo Yii::t('app', 'Are you sure you want to Log out?');
      Modal::end();
    ?>
    <?php $this->endBody() ?>
    <div style="display: none"><?= Yii::$app->setting->get('statisticsCode') ?></div>
</body>
</html>
<?php $this->endPage() ?>
