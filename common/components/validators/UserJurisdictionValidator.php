<?php

/**
 * Description of WktValidator
 *
 * @author victor.leite
 */

namespace common\components\validators;

use yii\validators\Validator;

class UserJurisdictionValidator extends Validator {

    public $codeIn = '3857';
    public $codeOut = '4326';

    public function validateAttribute($model, $attribute) {
	try {
	    $query = "SELECT operative.polygon_valid_to_user_juridiction(:user_id, ST_Transform(ST_GeometryFromText(:polygon,$this->codeIn),$this->codeOut) ) AS isvalid";
	    $res = \Yii::$app->db->createCommand($query)
		    ->bindValue(':user_id', \Yii::$app->user->id)
		    ->bindValue(':polygon', $model->$attribute)
		    ->queryOne();
		    //->getRawSql();
	    
	    //\Yii::$app->dumper->debug($res, true);

	    
	    if (empty($res['isvalid']) || $res['isvalid'] == False) {
		$this->addError($model, $attribute, \yii::t('translation', 'alert.message_error_jurisdiction_out_of_bound'));
	    }
	    
	} catch (Exception $e) {
	    $this->addError($model, $attribute, $e->getCode() . ' - ' . substr($e->getMessage(), 0, 300));
	} finally {
	    return $res;
	}
    }

}
