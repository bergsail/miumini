<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use app\widgets\comment\Comment;

/* @var $this yii\web\View */
/* @var $model app\modules\home\models\Album */

// LightBoxAsset::register($this);

$this->title = $model->post_title;

?>

<div id="creation-post-view-wrapper">
	<div id="creation-post-view-content">
		<div class="panel">
		    <articel class="post-view">
		        <div id = "creation-post-view-cover">
		            <img src="<?=$model->post_path?>">
		        </div>
		        <header>
		            <h1 class="post-title">
		                <?php if ($model->status == 'private'): ?>
		                    <i class="glyphicon glyphicon-lock"></i>
		                <?php endif ?>
		                <?= Html::encode($model->post_title) ?>
		                <small><?= Html::a(Yii::t('app', 'Edit'), ['/home/creation/update', 'id' => $model->id]) ?></small>
		            </h1>
		            <div class="post-meta">
		                <i class="glyphicon glyphicon-time icon-muted"></i> <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?>
		                <i class="glyphicon glyphicon-heart icon-muted"></i>20
		            </div>
		        </header>
		        <div class="post-content">
		            <?= HtmlPurifier::process($model->post_content) ?>
		            <?php $post_tags = $model->post_tags ? explode(',',$model->post_tags):[]; $tags_len = count($post_tags);?>
		            <?php if($tags_len > 0):?>
		                <p>
		                    <?php $i = 1; foreach((array)$post_tags as $ptag):?>
		                        <span class="label label-default"><i class="glyphicon glyphicon-tag"></i> <?= Html::encode($ptag) ?></span>
		                        <?php if($i<$tags_len):?>&nbsp;&nbsp;<?php endif;?>
		                        <?php $i++;?>
		                    <?php endforeach;?>
		                </p>
		            <?php endif ?>
		        </div>
		    </articel>
		</div>
		<div id="creation-post-view-comment">
			<?= Comment::widget([
			    'tableId' => $model->id,
			    'tableName' => $model->tableName(),
			]) ?>
		</div>
	</div>
	<div id="creation-post-view-link">
	   <div id="creation-post-view-link-user">
	       <img src = "/frontend/web/uploads/user/avatar/default/15.jpg">
	       <div id ="creation-post-view-user-info">
	          <a>小雨儿-rain</a>
	          <p>向来情深 奈何缘浅</p>
	       </div>
	       <div id="creation-post-view-care">
	          <a class="btn" href="">
		          <span class="glyphicon glyphicon-plus"></span> 
		          关注
	          </a>
           </div>
	   </div>
	   <div id="creation-post-view-link-tune" dataimg="<?=$model->tune_path?>">
		   <div id="wrapper">
				<audio preload="auto" controls>
					<source src="http://staticwebpage.bj.bcebos.com/temp/BlueDucks_FourFlossFiveSix.mp3">
					<source src="http://staticwebpage.bj.bcebos.com/temp/BlueDucks_FourFlossFiveSix.ogg">
					<source src="http://staticwebpage.bj.bcebos.com/temp/BlueDucks_FourFlossFiveSix.wav">
				</audio>
			</div>
	   </div>
	   <div id="creation-post-view-link-opus" dataimg="<?=$model->opus_path?>"> 
	       <div id="opus-wrapper">
	            <a href="<?= Url::toRoute(['/home/creation/opusview', 'id' => $model->id]) ?>" target="_blank">
	              <img src="">
	            </a>
	       </div>
	   </div>
	</div>
</div>




