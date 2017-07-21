<?php

namespace webapp\modules\communication\models;

use Yii;
use \webapp\modules\communication\models\base\TriggerFilter as BaseTriggerFilter;

/**
 * This is the model class for table "communication.trigger_filter".
 */
class TriggerFilter extends BaseTriggerFilter {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['group_id', 'behavior_id', 'event_id', 'risk_id', 'country_id', 'region_id', 'state_id', 'city_id'], 'integer'],
		[['behavior_id', 'event_id', 'risk_id'], 'required']
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'triggerfilter.id'),
	    'group_id' => Yii::t('translation', 'triggerfilter.group_id'),
	    'behavior_id' => Yii::t('translation', 'triggerfilter.behavior_id'),
	    'event_id' => Yii::t('translation', 'triggerfilter.event_id'),
	    'risk_id' => Yii::t('translation', 'triggerfilter.risk_id'),
	    'country_id' => Yii::t('translation', 'triggerfilter.country_id'),
	    'region_id' => Yii::t('translation', 'triggerfilter.region_id'),
	    'state_id' => Yii::t('translation', 'triggerfilter.state_id'),
	    'city_id' => Yii::t('translation', 'triggerfilter.city_id'),
	];
    }

}
