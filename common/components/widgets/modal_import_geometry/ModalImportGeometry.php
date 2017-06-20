<?php

namespace common\components\widgets\modal_import_geometry;

use yii\base\Widget;

/**
 * Description of modalImportGeometry
 *
 * @author victor.leite
 */
class ModalImportGeometry extends Widget {

    public $id;
    public $outputField;
    public $toggleButton;
    public $options;

    public function init() {
	ModalImportGeometryAssets::register($this->getView());
	parent::init();
    }

    public function run() {

	return $this->render('modal-import-geometry', [
		    'id' => $this->id,
		    'outputField' => $this->outputField,
		    'options' => $this->options,
		    'toggleButton' => $this->toggleButton
	]);
    }

}
