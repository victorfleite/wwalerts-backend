<?php

namespace webapp\modules\communication\models;

use Yii;
use \webapp\modules\communication\models\base\RlTriggerGroup as BaseRlTriggerGroup;

/**
 * This is the model class for table "communication.rl_trigger_group".
 */
class RlTriggerGroup extends BaseRlTriggerGroup {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['trigger_id', 'group_id'], 'required'],
		[['trigger_id', 'group_id'], 'integer']
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'trigger_id' => Yii::t('translation', 'rltriggergroup.trigger_id'),
	    'group_id' => Yii::t('translation', 'rltriggergroup.group_id'),
	];
    }

}
