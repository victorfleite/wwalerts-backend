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
		[['behavior_id', 'event_id', 'risk_id'], 'integer'],
		[['name', 'behavior_id', 'event_id', 'risk_id'], 'required'],
		[['description'], 'safe'],
		[['behavior_id', 'event_id', 'risk_id'], 'unique', 'targetAttribute' => ['behavior_id', 'event_id', 'risk_id'], 'message' => \Yii::t('translation', 'trigger.unique_key_behavior_event_risk')],
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'trigger.id'),
	    'behavior_id' => Yii::t('translation', 'trigger.behavior_id'),
	    'event_id' => Yii::t('translation', 'trigger.event_id'),
	    'risk_id' => Yii::t('translation', 'trigger.risk_id'),
	    'name' => Yii::t('translation', 'trigger.name'),
	    'description' => Yii::t('translation', 'trigger.description'),
	];
    }

}
