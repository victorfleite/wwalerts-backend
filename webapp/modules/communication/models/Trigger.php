<?php

namespace webapp\modules\communication\models;

use Yii;
use \webapp\modules\communication\models\base\Trigger as BaseTrigger;

/**
 * This is the model class for table "communication.trigger".
 */
class Trigger extends BaseTrigger implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['behavior_id', 'event_id', 'risk_id'], 'integer'],
		[['name', 'behavior_id', 'status'], 'required'],
		[['description'], 'safe'],
		[['behavior_id', 'event_id', 'risk_id'], 'checkUnique'],
	];
    }

    public function checkUnique($attribute, $params, $validator) {

	$eventId = $this->event_id;
	if (empty($eventId)) {
	    $eventId = null;
	}
	$riskId = $this->risk_id;
	if (empty($riskId)) {
	    $riskId = null;
	}
	$query = Trigger::find()->where(['behavior_id' => $this->behavior_id, 'event_id' => $eventId, 'risk_id' => $riskId]);
	if (!$this->isNewRecord) {
	    $query->andWhere(['<>', 'id', $this->id]);
	}
	$founded = $query->exists();
	if ($founded) {
	    $this->addError($attribute, \Yii::t('translation', 'trigger.unique_key_behavior_event_risk'));
	}
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

    /**
     * @return Array
     */
    public function getAllGroupsIds() {
	$groups = parent::getGroups()->all();
	$groupsIds = [];
	if (is_array($groupsIds)) {
	    foreach ($groups as $g) {
		$groupsIds[] = $g->id;
	    }
	}
	
	return $groupsIds;
    }

}
