<?php

namespace webapp\modules\communication\models;

use Yii;
use \webapp\modules\communication\models\base\Trigger as BaseTrigger;

/**
 * This is the model class for table "communication.trigger".
 */
class Trigger extends BaseTrigger {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['group_id', 'behavior_id', 'event_id', 'risk_id'], 'integer'],
		[['behavior_id', 'event_id', 'risk_id'], 'required'],
		[['behavior_id', 'event_id', 'risk_id'], 'unique', 'targetAttribute' => ['behavior_id', 'event_id', 'risk_id'], 'message' => 'The combination of Behavior ID, Event ID and Risk ID has already been taken.'],
		[['group_id', 'behavior_id'], 'unique', 'targetAttribute' => ['group_id', 'behavior_id'], 'message' => 'The combination of Group ID and Behavior ID has already been taken.']
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'group_id' => Yii::t('translation', 'trigger.group_id'),
	    'behavior_id' => Yii::t('translation', 'trigger.behavior_id'),
	    'event_id' => Yii::t('translation', 'trigger.event_id'),
	    'risk_id' => Yii::t('translation', 'trigger.risk_id'),
	];
    }

}
