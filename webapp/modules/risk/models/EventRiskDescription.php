<?php

namespace webapp\modules\risk\models;

use Yii;
use \webapp\modules\risk\models\base\EventRiskDescription as BaseEventRiskDescription;

/**
 * This is the model class for table "risk.event_risk_description".
 */
class EventRiskDescription extends BaseEventRiskDescription {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['name_i18n', 'risk_id', 'event_id'], 'required'],
		[['created_at', 'updated_at'], 'safe'],
		[['created_by', 'updated_by', 'risk_id', 'event_id'], 'integer'],
		[['hash'], 'string'],
		[['name_i18n'], 'string', 'max' => 300],
		[['risk_id', 'event_id'], 'unique', 'targetAttribute' => ['risk_id', 'event_id'], 'message' => 'The combination of Risk ID and Event ID has already been taken.']
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'event_risk_description.id'),
	    'name_i18n' => Yii::t('translation', 'event_risk_description.name_i18n'),
	    'event_id' => Yii::t('translation', 'event_risk_description.event_id'),
	    'risk_id' => Yii::t('translation', 'event_risk_description.risk_id'),
	    'created_at' => Yii::t('translation', 'event_risk_description.created_at'),
	    'updated_at' => Yii::t('translation', 'event_risk_description.updated_at'),
	    'created_by' => Yii::t('translation', 'event_risk_description.created_by'),
	    'updated_by' => Yii::t('translation', 'event_risk_description.updated_by'),	    
	    'hash' => Yii::t('translation', 'event_risk_description.hash'),
	];
    }

}
