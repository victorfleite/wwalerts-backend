<?php

/**
 * Description of CommunicationBehaviorValidator
 *
 * @author victor.leite
 */

namespace common\components\validators;

use yii\validators\Validator;
use yii\db\Exception;
use \common\components\behaviors\communication\CommunicationBehavior;

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
	    if(!($obj instanceof CommunicationBehavior)){
		$this->addError($model, $attribute, \Yii::t('translation', 'behavior.class_error_instenceof_message'));		
	    }
	} catch (Exception $e) {
	    $this->addError($model, $attribute, $e->getCode() . ' - ' . substr($e->getMessage(), 0, 300));
	} finally {
	    return $res;
	}
    }

}
