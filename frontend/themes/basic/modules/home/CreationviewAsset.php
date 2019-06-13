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
class CreationviewAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/basic/modules/home/assets';
    public $css = [
        'css/creationview.css',
        // 'css/reset.css',
        'css/audioplayer.css' 
    ];
    public $js = [        
        'js/creationview.js',
        'js/audioplayer.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
 
}
