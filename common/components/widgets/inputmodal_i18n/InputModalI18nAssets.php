<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components\widgets\inputmodal_i18n;

/**
 * Description of InputModalI18nAssets
 *
 * @author victor.leite
 */
class InputModalI18nAssets extends \yii\web\AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
	'yii\web\JqueryAsset',
	'yii\web\YiiAsset',	
        'yii\bootstrap\BootstrapAsset',
    ];

}
