<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

if (!isset($this->title)) {
    $this->title = Yii::$app->setting->get('siteTitle');
}

if (Yii::$app->user->isGuest) {
    $this->beginContent(__DIR__.'/main.php');
} else {
    $this->beginContent('@app/modules/user/views/layouts/user.php');
    $this->registerCssFile('@web/css/site.css');
    $this->registerCss('
        @media (min-width: 1200px) {
          .container {
            width: 970px;
          }
        }
        #navbar-fields {
          min-height: 30px;
          width:782px;
          margin-bottom: 0px;
          margin-top:52px;
          background-color: #fff;
          white-space: nowrap;
          border-radius: 0px;
          border: 0;

          position: fixed!important;
          z-index: 999;
        }

        #navbar-fields li {
          padding-top:0!important;
          padding-bottom:0!important;
          padding-right:0!important;
        }

        #navbar-fields .container {
          width:100%;
          padding:0px;
        }

        #navbar-fields .container #navbar-fields-collapse {
          padding:0px;
          border-color: #ffffff;
        }

        #navbar-fields-item li {
          border:1px solid #999999;
          border-radius: 16px;
          margin:18px 18px 18px 0px;
        }

        #navbar-fields-item li.active {
          border:1px solid #c1b561;
        }

        #navbar-fields-item li a {
          padding:5px 10px;
          background-color: transparent;
          outline: none;
        }

        #navbar-fields-item li a:active {
          star:expression(this.onFocus=this.blur());
        }

    ');
}
$this->registerMetaTag(['name' => 'keywords', 'content' => Yii::$app->setting->get('siteKeyword')]);
$this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->setting->get('siteDescription')]);
$this->registerCss('
    .wrap {background-color: #FFF;}
');
?>
<div class="wrap">
<!-- 
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
 -->
    <?php
    NavBar::begin([

        'options' => [
            'id' =>'navbar-fields',
            'class' => 'navbar-default',
        ],
    ]);
    // '<i class="glyphicon glyphicon-list-alt"></i> ' . 
    // '<i class="glyphicon glyphicon-picture"></i> ' .
    // '<i class="glyphicon glyphicon-comment"></i> ' . 
    $menuItems = [
        [   'label' => Yii::t('app', 'Posts'),
            'url' => ['/explore/posts']
        ],
        [
            'label' => Yii::t('app', 'Opuses'),
            'url' => ['/explore/opuses'],
            'linkOptions' => ['data-pjax' => 0]
        ],
        [
            'label' =>  Yii::t('app', 'Forums'),
            'url' => ['/explore/index'],
            'linkOptions' => ['data-pjax' => 0]
        ]
    ];
    echo Nav::widget([
        'options' => ['id' =>'navbar-fields-item', 'class' => 'navbar-nav'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

     
    <div id = "right-post">
          <div id = "post-data">
           <img src = "http://staticwebpage.bj.bcebos.com/temp/post.jpg">
        </div>
    </div>

    <div id = "explore-container" <?= (Yii::$app->user->isGuest) ? 'class="container"' : 'style="padding: 0 0px;"' ?> >
   <!--      <?= Breadcrumbs::widget([
            'homeLink' => ['label' => Yii::t('app', 'Explore'), 'url' => ['/explore/index']],
            'links' => isset($this->params['breadcrumb']) ? $this->params['breadcrumb'] : [],
        ]) ?> -->

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
