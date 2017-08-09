<?php

namespace webapp\modules\communication\models;

use yii\base\Model;

/**
 * Description of AssociateTriggerWorkgroupForm
 *
 * @author victor.leite
 */
class AssociateTriggerWorkgroupForm extends Model {

    public $workgroups;

    /**
     * @return array the validation rules.
     */
    public function rules() {
	return [
		['workgroups', 'safe']
	];
    }
    
       /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'workgroups' => \Yii::t('translation', 'trigger.associate_workgroup_dualbox_title'),
	];
    }

}
