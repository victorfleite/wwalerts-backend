<?php

namespace common\components\widgets\modal_import_geometry;

use yii\web\AssetBundle;

/**
 * Description of ModalImportGeometryAssets
 *
 * @author victor.leite
 */
class ModalImportGeometryAssets extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
	'yii\web\JqueryAsset',
    ];

}
