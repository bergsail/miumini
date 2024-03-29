<?php
/**
 * @link http://www.iisns.com/
 * @copyright Copyright (c) 2015 iiSNS
 * @license http://www.iisns.com/license/
 */
namespace iisns\webuploader;

use Yii;

/**
 * 图片裁剪上传
 *  为了能够预览它，需要在你想要预览的地方放下如下代码：
 *  <div class="fileupload fileupload-new">
 *      <div class="img-preview"></div>
 *  </div>
 * 在你想要出现“选择文件”的地方，放下如下代码：
 * <?= Cropper::widget() ?>
 *
 * @author Shiyang <dr@shiyang.me>
 */
class Cropper extends WebUploader
{
	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		$this->registerClientScript();
		return $this->render('cropper');
	}

	/**
	        
	 * Registers Webuploader assets
	 */
	protected function registerClientScript()
	{
		$view = $this->getView();
		CropperAsset::register($view);
		$js = "

		";
		$view->registerJs($js, $view::POS_READY);
	}
}
