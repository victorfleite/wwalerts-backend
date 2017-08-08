<?php

namespace webapp\modules\communication\models;

use yii\base\Model;

/**
 * Description of AssociateTriggerGroupForm
 *
 * @author victor.leite
 */
class AssociateTriggerGroupForm extends Model {

    public $groups;

    /**
     * @return array the validation rules.
     */
    public function rules() {
	return [
		['groups', 'safe']
	];
    }
    
       /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'groups' => \Yii::t('translation', 'trigger.associate_group_dualbox_title'),
	];
    }

}
