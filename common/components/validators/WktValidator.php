<?php

/**
 * Description of WktValidator
 *
 * @author victor.leite
 */

namespace common\components\validators;

use yii\validators\Validator;
use yii\db\Exception;

class WktValidator extends Validator {
    public $wktErrorReason;
    public $wktErrorLocation;
     
    public function validateAttribute($model, $attribute) {
	$checkValidation = $this->checkValidWkt($model, $attribute);
	//\Yii::$app->dumper->debug($checkValidation, true);
	if (isset($checkValidation) && ($checkValidation['is_valid'] == false)) {
	   $wktErrorMessage = new \common\components\WktErrorMessage();
	   $wktErrorMessage->setReason($checkValidation['reason']);
	   $wktErrorMessage->setLocation($checkValidation['location']);
	   $model->wktErrorMessage = $wktErrorMessage;
	   $this->addError($model, $attribute, \Yii::t('translation', 'wkt_invalid_autointesect'));
	}
    }

    public function checkValidWkt($model, $attribute) {
	$wkt = $model->$attribute;
	try {
	    $q = "SELECT ST_IsValid(ST_GeomFromText('$wkt')) As is_valid, reason(ST_IsValidDetail(ST_GeomFromText('$wkt'))) as reason, ST_AsText(location(ST_IsValidDetail(ST_GeomFromText('$wkt')))) as location";
	    $res = \Yii::$app->db->createCommand($q)->queryOne();
	    
	} catch (Exception $e) {
	    $this->addError($model, $attribute, $e->getCode().' - '.substr($e->getMessage(), 0, 300));
	} finally {
	    return $res;
	}
	
	
    }

}
