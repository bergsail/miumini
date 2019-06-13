<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use app\themes\basic\modules\home\CreationopusviewAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

CreationopusviewAsset::register($this);

?>
<?php $this->beginPage() ?>

    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=1280">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="<?= Yii::getAlias('@web') ?>/favicon.ico">
        <?php $this->head() ?>
    </head>

    <body>
     <?php $this->beginBody() ?> 
       <div class="tools-bar" id="top-bar-fixed">
		    <div class="left">
		        <div class="item-wrap back-wrap">
		            <a href="#" class="back">
		                <b class="back-ic"></b>
		                <span class="back-text">退出读谱</span>
		            </a>
		        </div>
		    </div>

		    <div class="center">
		        <div class="title">
		            <div class="title-text">歌剧<<卡门>> 第一幕第5曲 哈巴涅拉 比才曲
		            </div>
		        </div>
		        <div class="percent">
		            <div class="percent-text">1%
		            </div>
		        </div>
		    </div>

		</div>

       <div class="container">
          <?= $content ?>
       </div>
      
	    <div class = "song-list-wrap" id = "song-list-wrap">
	        <ul> 
	           <li class = "song-item" id = "song-item0" page-size = "10" opus-id = "0000001"  opus-name = "Bizet_Carmen_Habanera_VoilinCello" opus-active = "false">
	            <!--   <div class = "song-info"> -->
	                   <div class="album-pic">
	                        <img src="/resource/album.jpg" alt="">
	                   </div>
	                   <div class = "album-name">
	                        <a >哈巴涅拉1</a>
	                   </div>
	                   <div class = "album-player">
	                        <p>群星1</p>
	                   </div>
	              <!-- </div> -->
	           </li> 
	           <li class = "song-item" id = "song-item1" page-size = "10" opus-id = "0000002" opus-name = "Bizet_Carmen_Habanera_VoilinCello" opus-active = "false">
	               <!-- <div class = "song-info"> -->
	                   <div class="album-pic">
	                        <img src="/resource/album.jpg" alt="">
	                   </div>
	                   <div class = "album-name">
	                        <a >哈巴涅拉2</a>
	                   </div>
	                   <div class = "album-player">
	                        <p>群星2</p>
	                   </div>
	               <!-- </div> -->
	           </li> 
	           <li class = "song-item" id = "song-item2" page-size = "10" opus-id = "0000003" opus-name = "Bizet_Carmen_Habanera_VoilinCello" opus-active = "true">
	               <!-- <div class = "song-info"> -->
	                   <div class="album-pic">
	                        <img src="/resource/album.jpg" alt="">
	                   </div>
	                   <div class = "album-name">
	                        <a >哈巴涅拉3</a>
	                   </div>
	                   <div class = "album-player">
	                        <p>群星3</p>
	                   </div>
	               <!-- </div> -->
	           </li> 
	           <li class = "song-item" id = "song-item3" page-size = "10" opus-id = "0000004" opus-name = "Bizet_Carmen_Habanera_VoilinCello" opus-active = "false">
	               <!-- <div class = "song-info"> -->
	                   <div class="album-pic">
	                        <img src="/resource/album.jpg" alt="">
	                   </div>
	                   <div class = "album-name">
	                        <a >哈巴涅拉4</a>
	                   </div>
	                   <div class = "album-player">
	                        <p>群星4</p>
	                   </div>
	               <!-- </div> -->
	            </li> 
	        </ul> 
		</div>

		<div class = "bottom-control-panel">

		    <div class = "song-info" id = "current-song" opusid = "00000003" opus-name = "Bizet_Carmen_Habanera_VoilinCello">

		    </div>
		    <div class = "song-control">
		        <div id="audioplayer">
		        </div>
		        <div class = "play-ic" id = "play-ic"></div>
		        <div class = "pause-ic" id = "pause-ic"></div>
		        <div class = "progress-wrap">
		            <div class = "progress" id = "progress"> 
		               <div class="time-bar" value="77" max="100" percent="77%">
		                  <div class = "time-bar-progress" id ="time-bar-progress" ></div>
		               </div> 
		               <div class = "progress-image" id = "progress-ic"></div>
		            </div>
		        </div>
		        <div class = "time-total-wrap">
		            <span class="time-current">00:00</span>
		            <span> / </span>
		            <span class="time-total">00:00</span>
		        </div>

		        <div class = "song-sns">
		           <div class = "collect-ic">
		           </div>
		           <div class = "download-ic">
		           </div>
		       </div>
		    </div>
		</div>
     <?php $this->endBody() ?>

    </body>

    </html>

<?php $this->endPage() ?>