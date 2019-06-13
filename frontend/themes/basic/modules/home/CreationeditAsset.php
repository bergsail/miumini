<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\themes\basic\modules\home;

use yii\web\AssetBundle;

/**
 * @author Yang fan <bergsail@163.com>
 */
class CreationeditAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/basic/modules/home/assets';
    public $css = [
        'css/creationedit.css' ,
        'css/default.css', 
        'css/component.css' ,
        'css/animations.css',
   
        'css/font-awesome.min.css',
        'css/bootstrap-editable.min.css',
        'css/ace.min.css'
    ];
    public $js = [
        'js/modernizr.custom.js',
        'js/pagetransitions.js',

        'js/bootstrap-tag.min.js',
        'js/jquery.hotkeys.min.js',
        'js/bootstrap-editable.min.js',

        'js/ace-elements.min.js',
        'js/ace.min.js',
        
        'js/creationedit.js',

    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
 
}
