<?php

namespace webapp\modules\risk\models;

use Yii;
use \webapp\modules\risk\models\base\EventRiskInstruction as BaseEventRiskInstruction;

/**
 * This is the model class for table "risk.event_risk_instruction".
 */
class EventRiskInstruction extends BaseEventRiskInstruction {

    /**
     * @inheritdoc
     */
    public function rules() {
	return array_replace_recursive(parent::rules(), [
		[['name_i18n', 'risk_id', 'event_id'], 'required'],
		[['created_at', 'updated_at'], 'safe'],
		[['created_by', 'updated_by', 'risk_id', 'event_id'], 'integer'],
		[['hash'], 'string'],
		[['name_i18n'], 'string', 'max' => 300],
		[['risk_id', 'event_id'], 'unique', 'targetAttribute' => ['risk_id', 'event_id'], 'message' => 'The combination of Risk ID and Event ID has already been taken.']
	]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'event_risk_instruction.id'),
	    'name_i18n' => Yii::t('translation', 'event_risk_instruction.name_i18n'),
	    'event_id' => Yii::t('translation', 'event_risk_instruction.event_id'),
	    'risk_id' => Yii::t('translation', 'event_risk_instruction.risk_id'),
	    'created_at' => Yii::t('translation', 'event_risk_instruction.created_at'),
	    'updated_at' => Yii::t('translation', 'event_risk_instruction.updated_at'),
	    'created_by' => Yii::t('translation', 'event_risk_instruction.created_by'),
	    'updated_by' => Yii::t('translation', 'event_risk_instruction.updated_by'),
	    'hash' => Yii::t('translation', 'event_risk_instruction.hash'),
	];
    }

}
