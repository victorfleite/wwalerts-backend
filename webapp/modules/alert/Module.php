<?php

namespace webapp\modules\alert;

/**
 * alert module definition class
 */
class Module extends \yii\base\Module {

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'webapp\modules\alert\controllers';
    /**
     *
     * @var type 
     */
    public $defaultRoute = 'alert/index';

    /**
     * @inheritdoc
     */
    public function init() {
	parent::init();

	// custom initialization code goes here
    }

}
