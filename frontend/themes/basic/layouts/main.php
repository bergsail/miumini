<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

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
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?= Yii::getAlias('@web') ?>/favicon.ico">
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <header id="header" class="hidden-xs">
        <?php
            NavBar::begin([
                'brandLabel' => '<img src="http://staticwebpage.bj.bcebos.com/temp/logo.png" style="display:inline; margin-top: 0;vertical-align: middle; height:50px;">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'id' => 'logo-wrapper',
                    'class' => 'navbar-default navbar-registerlogin',
                ],
            ]);
            // $menuItems = [
            //     ['label' => '<i class="glyphicon glyphicon-globe"></i> ' . Yii::t('app', 'Explore'), 'url' => ['/explore/index']],
            // ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => '<i class="glyphicon glyphicon-plus-sign"></i> ' . Yii::t('app', 'Sign up'), 'url' => ['/site/signup']];
                $menuItems[] = ['label' => '<i class="glyphicon glyphicon-log-in"></i> ' . Yii::t('app', 'Log in'), 'url' => ['/site/login']];
            } else {
                $menuItems[] = ['label' => '<i class="glyphicon glyphicon-dashboard"></i> ' . Yii::t('app', 'Dashboard'), 'url' => ['/user/dashboard']];
                $menuItems[] = [
                    'label' => '<i class="glyphicon glyphicon-log-out"></i> ' . Yii::t('app', 'Log out') . '(' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['id' => 'user-nav', 'class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>
        </header>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; <?= Html::a(Yii::$app->setting->get('siteName'), ['/site/index']) ?> <?= date('Y') ?>
            <?= Html::a (' 中文简体 ', '?lang=zh-CN') . '| ' . 
            Html::a (' English ', '?lang=en') ;  
            ?>
        </p>
        </div>
    </footer>
    <?php $this->endBody() ?>
    <div style="display: none"><?= Yii::$app->setting->get('statisticsCode') ?></div>
</body>
</html>
<?php $this->endPage() ?>
