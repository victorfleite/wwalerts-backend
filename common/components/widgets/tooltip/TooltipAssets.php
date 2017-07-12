<?php

namespace common\components\widgets\tooltip;

use yii\web\AssetBundle;

/**
 * Description of TooltipAssets
 *
 * @author victor.leite
 */
class TooltipAssets extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
	'yii\web\JqueryAsset',
	'yii\bootstrap\BootstrapPluginAsset'
    ];

}
