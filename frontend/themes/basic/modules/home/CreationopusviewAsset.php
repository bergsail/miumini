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
class CreationopusviewAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/basic/modules/home/assets';
    public $css = [
        'css/creationopusviewframe.css'
    ];
    public $js = [        
        'js/creationopusview.jquery.min.js',
        'js/creationopusview.jquery.jplayer.min.js',
        'js/creationopusview.snap.svg-min.js',
        'js/creationopusviewuiassist.js',
        'js/creationopusviewplayer.js'
    ];

    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapPluginAsset',
    ];
 
}
