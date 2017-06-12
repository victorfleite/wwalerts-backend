<?php

namespace backend\models;

use yii\base\Model;

/**
 * Description of AssociateJurisdictionWorkgroupForm
 *
 * @author victor.leite
 */
class AssociateJurisdictionWorkgroupForm extends Model {

    public $jurisdictions;

    /**
     * @return array the validation rules.
     */
    public function rules() {
	return [
		['jurisdictions', 'safe']
	];
    }
    
       /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'jurisdictions' => \Yii::t('translation', 'workgroup.associate_jurisdiction_dualbox_title'),
	];
    }

}
