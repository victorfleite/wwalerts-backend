<?php

/**
 * Description of CommunicationBehaviorValidator
 *
 * @author victor.leite
 */

namespace common\components\validators;

use yii\validators\Validator;
use \common\components\behaviors\communication\CommunicationBehavior;
use \common\components\behaviors\communication\iCommunicationBehavior;

class BehaviorClassValidator extends Validator {

    public function validateAttribute($model, $attribute) {
	$this->validateClassBehavior($model, $attribute);
    }

    public function validateClassBehavior($model, $attribute) {
	$class = $model->$attribute;
	try {
	    $obj = \Yii::createObject([
			'class' => $class,
	    ]);
	    // Check the Heritage
	    if (!($obj instanceof CommunicationBehavior)) {
		$this->addError($model, $attribute, \Yii::t('translation', 'behavior.class_error_instenceof_message', ['classChield' => $class, 'classParent' => CommunicationBehavior::className()]));
	    }
	    // Check the interface implementation
	    $reflect = new \ReflectionClass($class);
	    $iCommunicationBehaviorName = iCommunicationBehavior::class;
	    if (!$reflect->implementsInterface($iCommunicationBehaviorName)) {
		$this->addError($model, $attribute, \Yii::t('translation', 'behavior.class_error_instenceof_interface_message', ['classChield' => $class, 'interfaceClass' => $iCommunicationBehaviorName]));
	    }
	} catch (\yii\base\ErrorException $e) {
	    $this->addError($model, $attribute, $e->getCode() . ' - ' . substr($e->getMessage(), 0, 300));
	} finally {

	    return;
	}
    }

}
