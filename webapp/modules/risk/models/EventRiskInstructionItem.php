<?php

namespace webapp\modules\risk\models;

use Yii;
use \webapp\modules\risk\models\base\EventRiskInstructionItem as BaseEventRiskInstructionItem;

/**
 * This is the model class for table "risk.event_risk_instruction_item".
 */
class EventRiskInstructionItem extends BaseEventRiskInstructionItem {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['event_risk_instruction_id', 'status', 'order'], 'integer'],
		[['description_i18n', 'status'], 'required'],
		[['description_i18n'], 'string', 'max' => 300]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'event_risk_instruction_item.id'),
	    'event_risk_instruction_id' => Yii::t('translation', 'event_risk_instruction_item.event_risk_instruction_id'),
	    'description_i18n' => Yii::t('translation', 'event_risk_instruction_item.description_i18n'),
	    'status' => Yii::t('translation', 'event_risk_instruction_item.status'),
	    'order' => Yii::t('translation', 'event_risk_instruction_item.order'),
	];
    }

}
