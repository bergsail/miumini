<?php
// use iisns\webuploader\MultiImage;
use yii\widgets\ActiveForm;
use iisns\webuploader\Cropper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\home\models\Creation */

$this->params['id'] = $model->id;
$this->title = Yii::t('app', 'Create Creation');

$this->registerCss('
	');
?>

<div class="creation-create">
    <div id="pt-main" class="pt-perspective">
        <div class="pt-page pt-page-1">

              <div id="creation-cover-pic-post" class="main-container" dataid="<?=$model->id?>"> 
                 <div class = "pic-preview" id="creation-cover-pic-post-preview">
                   <div id="creation-cover-pic-post-preview-content">
                       <img src="<?= $model['post_path'] ?>" style="width:100%;height:100%">
                   </div>
                   <div id="post-cover-click-upload-wrapper" class="pick-uploader">
                       <span>
                          <span class="grey">点击上传封面</span>
                          <i class="upload-icon ace-icon fa fa-plus fa-x"></i>
                       </span>
                    </div>
                    <div id="post-cover-click-change-wrapper">
                        <span>
                         <a class="btn btn-sm"> 
                            <i class="change-icon ace-icon fa fa-photo"></i>
                         </a>
                        </span>
                    </div>
                   <img src="" alt=""/>
                 </div>
                 <div id="creation-cover-pic-post-copper-wrapper">
                    <?= Cropper::widget(); ?>
                 </div>
		      </div>
              <?php $form = ActiveForm::begin(['id'=>'creation_post_form']); ?>

                 <?= $form->field($model, 'post_title', [
                  'template' => "<div id=\"form-creation-title-wrap-post\">{input}</div>",
                  ])->textInput(['id'=>'form-creation-title-post',
                              'placeholder'=>'请输入标题（30字)',
                              // 'class'=>'col-xs-10 col-sm-5', 
                              'maxlength' => '60']) ?>

                 <?= $form->field($model, 'post_tags',[
                  'template' => "<div id=\"form-creation-tags-wrap-post\">{input}</div>",
                  ])->textInput(['id'=>'form-field-tags-post',
                                 'placeholder'=>'请按回车输入标签 ...（选填)',
                                 'type'=>'text',
                                 // 'name'=>'tags'
                                ])?>

                  <?= $form->field($model, 'post_content')->widget('shiyang\umeditor\UMeditor', [
                      'clientOptions' => [
                          'initialFrameHeight' => 230,
                          'toolbar' => [
                              'undo redo | bold italic underline |',
                              'image |',
                              'justifyleft justifycenter justifyright justifyjustify |',
                              'insertorderedlist insertunorderedlist |' ,
                              'horizontal',
                          ],
                      ]
                  ])->label(false) ?>

              <?php ActiveForm::end(); ?>
         </div>
         <div class="pt-page pt-page-2">

              <div id="creation-audio-editor" dataid="<?=$model->id?>" dataurl="<?=$model->tune_content?>">

                   <div id="creation-cover-pic-tune" class="main-container" dataid="<?=$model->id?>"> 
                       <div class = "pic-preview" id="creation-cover-pic-tune-preview">
                           <div id="creation-cover-pic-tune-preview-content">
                               <img src="<?= $model['tune_path'] ?>" style="width:100%;height:100%">
                           </div>
                           <div id="tune-cover-click-upload-wrapper" class="pick-uploader">
                               <span>
                                  <span class="grey">点击上传封面</span>
                                  <i class="upload-icon ace-icon fa fa-plus fa-x"></i>
                               </span>
                           </div>
                           <div id="tune-cover-click-change-wrapper" class="pick-uploader">
                               <span>
                                 <a class="btn btn-sm"> 
                                    <i class="change-icon ace-icon fa fa-photo"></i>
                                 </a>
                               </span>
                           </div>
                           <img src="" alt=""/>
                       </div>
                       <div id="creation-cover-pic-tune-copper-wrapper">
                          <?= Cropper::widget(); ?>
                       </div>
                   </div>

                   <div id="creation-info-tune">
	                    <div id="form-creation-audio-wrap">
		                   <form id="tune-form" method="post" action="/frontend/web/index.php/home/creation/upscore">
				               <input type="file" id="id-input-file-audio" name="score-tune"/>
			                   <button type="submit" id="tune-content-submit">
			                      <i class=" ace-icon fa fa-check"></i>
			                   </button>
			                   <button type="reset" id="tune-content-reset">
			                      <i class=" ace-icon fa fa-times"></i>
			                   </button>
			               </form>
	                    </div>
	                    <?php $form = ActiveForm::begin(['id'=>'creation_tune_form']); ?>
	                        <?= $form->field($model, 'tune_title', [
			                  'template' => "<div id=\"form-creation-title-wrap-tune\">{input}</div>",
			                  ])->textInput(['id'=>'form-creation-title-tune',
			                              'placeholder'=>'请输入标题（30字)',
			                              // 'class'=>'col-xs-10 col-sm-5', 
			                              'maxlength' => '60']) ?>

			                <?= $form->field($model, 'tune_tags',[
			                  'template' => "<div id=\"form-creation-tags-wrap-tune\">{input}</div>",
			                  ])->textInput(['id'=>'form-field-tags-tune',
			                                 'placeholder'=>'请按回车输入标签 ...（选填)',
			                                 'type'=>'text',
			                                 // 'name'=>'tags'
			                                ])?>
			            <?php ActiveForm::end(); ?>
	               </div>

              </div>
         </div>
         <div class="pt-page pt-page-3">
               <div id="creation-graphic-editor" dataid="<?=$model->id?>" dataurl="<?=$model->opus_content?>">
		             <div id="creation-cover-pic-opus" class="main-container" dataid="<?=$model->id?>"> 
                       <div class = "pic-preview" id="creation-cover-pic-opus-preview">
                           <div id="creation-cover-pic-opus-preview-content">
                               <img src="<?= $model['opus_path'] ?>" style="width:100%;height:100%">
                           </div>
                           <div id="opus-cover-click-upload-wrapper" class="pick-uploader">
                               <span>
                                  <span class="grey">点击上传封面</span>
                                  <i class="upload-icon ace-icon fa fa-plus fa-x"></i>
                               </span>
                           </div>
                           <div id="opus-cover-click-change-wrapper" class="pick-uploader">
                               <span>
                                 <a class="btn btn-sm"> 
                                    <i class="change-icon ace-icon fa fa-photo"></i>
                                 </a>
                               </span>
                           </div>
                           <img src="" alt=""/>
                       </div>
                       <div id="creation-cover-pic-opus-copper-wrapper">
                          <?= Cropper::widget(); ?>
                       </div>
                     </div>
		             <div id="creation-info-opus">
		                <div id="form-creation-graphic-wrap">
		                   <form id="opus-form" method="post" action="/frontend/web/index.php/home/creation/upscore">
				               <input type="file" id="id-input-file-graphic" name="score-opus"/>
			                   <button type="submit" id="opus-content-submit">
			                      <i class=" ace-icon fa fa-check"></i>
			                   </button>
			                   <button type="reset" id="opus-content-reset">
			                      <i class=" ace-icon fa fa-times"></i>
			                   </button>
			               </form>
						</div>
						<?php $form = ActiveForm::begin(['id'=>'creation_opus_form']); ?>
	                        <?= $form->field($model, 'opus_title', [
			                  'template' => "<div id=\"form-creation-title-wrap-opus\">{input}</div>",
			                  ])->textInput(['id'=>'form-creation-title-opus',
			                              'placeholder'=>'请输入标题（30字)',
			                              // 'class'=>'col-xs-10 col-sm-5', 
			                              'maxlength' => '60']) ?>

			                <?= $form->field($model, 'opus_tags',[
			                  'template' => "<div id=\"form-creation-tags-wrap-opus\">{input}</div>",
			                  ])->textInput(['id'=>'form-field-tags-opus',
			                                 'placeholder'=>'请按回车输入标签 ...（选填)',
			                                 'type'=>'text',
			                                 // 'name'=>'tags'
			                                ])?>
			            <?php ActiveForm::end(); ?>

		                <div id="creation-tab-wrapper">
							<div class="tabbable tabs-top" id="creation-tab">
								<ul class="nav nav-tabs" id="myTab3">
									<li class="active">
										<a data-toggle="tab" href="#home3">
											<i class="ace-icon fa fa-certificate bigger-110"></i>
											信息
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#profile3">
											<i class="ace-icon fa fa-calendar bigger-110"></i>
											年代
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#dropdown13">
											<i class="ace-icon fa fa-pencil"></i>
											其他
										</a>
									</li>
								</ul>
        
								<div class="tab-content" id="creation-tab-content">
									<div id="home3" class="tab-pane in active">
										<div class="profile-user-info profile-user-info-striped">
											<div class="profile-info-row">
												<div class="profile-info-name"> 作曲者</div>
												<div class="profile-info-value">
													<span class="editable" id="form-composer"><?=$model->opus_work_author?></span>
												</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name"> 作品号</div>
												<div class="profile-info-value">
													<span class="editable" id="form-opusid"><?=$model->opus_work_number?></span>
												</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name"> 乐章号</div>
												<div class="profile-info-value">
													<span class="editable" id="form-movementid"><?=$model->opus_work_movement?></span>
												</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name"> 调号</div>
												<div class="profile-info-value">
													<span class="editable" id="form-key"><?=$model->opus_work_key?></span>
												</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name"> 别名</div>
												<div class="profile-info-value">
													<span class="editable" id="form-alias"><?=$model->opus_work_alias?></span>
												</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name"> 乐器</div>
												<div class="profile-info-value">
													<span class="editable" id="form-instruments"><?=$model->opus_work_instruments?></span>
												</div>
											</div>
										</div>
									</div>

									<div id="profile3" class="tab-pane">
										<div class="profile-user-info profile-user-info-striped">
											<div class="profile-info-row">
												<div class="profile-info-name"> 创作时间</div>
												<div class="profile-info-value">
													<span class="editable" id="form-compose-time"><?=$model->opus_work_birth?></span>
												</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name"> 出版时间</div>
												<div class="profile-info-value">
													<span class="editable" id="form-publish-time"><?=$model->opus_work_production?></span>
												</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name"> 时期</div>
												<div class="profile-info-value">
													<span class="editable" id="form-period"><?=$model->opus_work_period?></span>
												</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name"> 风格</div>
												<div class="profile-info-value">
													<span class="editable" id="form-style"><?=$model->opus_work_style?></span>
												</div>
											</div>
										</div>
									</div>

									<div id="dropdown13" class="tab-pane">
										<div class="profile-user-info profile-user-info-striped">
											<div class="profile-info-row">
												<div class="profile-info-name"> 备注</div>
												<div class="profile-info-value">
													<span class="editable" id="form-notation"><?=$model->opus_work_notation?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- /.col -->

		             </div>

                    
		        </div>
         </div>
    </div>
</div>

