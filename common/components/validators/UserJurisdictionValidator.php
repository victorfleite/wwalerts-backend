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
	$query = "SELECT operative.polygon_valid_to_user_juridiction(:user_id, ST_Transform(GeometryFromText(:polygon,$codeIn),$codeOut) ) AS isvalid";
	$res = \Yii::$app->db->createCommand($query)
		->bindValue(':user_id', \Yii::$app->user->id)
		->bindValue(':polygon', $this->$attribute)
		->queryOne();
	if (empty($res['isvalid']) || $res['isvalid'] == False) {
	    $this->addError($this->$attribute, \yii::t('translation', 'alert.message_error_jurisdiction_out_of_bound'));
	}
    }

}
