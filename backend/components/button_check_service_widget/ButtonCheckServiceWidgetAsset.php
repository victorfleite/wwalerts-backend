<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\components\button_check_service_widget;

use yii\web\AssetBundle;
/**
 * Description of ButtonCheckServiceWidgetAssets
 *
 * @author educatux
 */
class ButtonCheckServiceWidgetAsset extends AssetBundle  {
    public $sourcePath = '@app/components/button_check_service_widget/assets';
    public $css = ['main.css'];
    //public $js = ['main.js'];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
