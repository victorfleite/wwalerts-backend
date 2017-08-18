<?php

namespace webapp\modules\alert\models;

use Yii;
use \webapp\modules\alert\models\base\Cap as BaseCap;

/**
 * This is the model class for table "alert.cap".
 */
class Cap extends BaseCap {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['alert_id', 'institution_id', 'event_id', 'risk_id', 'identifier', 'sender', 'msgtype', 'scope', 'category', 'event', 'urgency', 'severity', 'certainty', 'onset', 'expires', 'sendername', 'headline', 'instruction', 'description', 'contact', 'areadesc', 'polygon', 'sequencecap', 'caphead', 'language', 'polygonwkt', 'xmlfile', 'user_id', 'type'], 'required'],
		[['alert_id', 'institution_id', 'event_id', 'risk_id', 'sequencecap', 'caphead', 'user_id', 'parent_id'], 'integer'],
		[['sent', 'onset', 'expires'], 'safe'],
		[['instruction', 'description', 'areadesc', 'polygon', 'polygonwkt', 'references', 'hash'], 'string'],
		[['identifier', 'sender', 'status', 'scope', 'category', 'responsetype', 'urgency', 'severity', 'certainty'], 'string', 'max' => 64],
		[['msgtype'], 'string', 'max' => 32],
		[['event', 'sendername', 'headline', 'contact'], 'string', 'max' => 128],
		[['language'], 'string', 'max' => 16],
		[['xmlfile'], 'string', 'max' => 256],
		[['type'], 'string', 'max' => 5]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'cap.id'),
	    'alert_id' => Yii::t('translation', 'cap.alert_id'),
	    'institution_id' => Yii::t('translation', 'cap.institution_id'),
	    'event_id' => Yii::t('translation', 'cap.event_id'),
	    'risk_id' => Yii::t('translation', 'cap.risk_id'),
	    'identifier' => Yii::t('translation', 'cap.identifier'),
	    'sent' => Yii::t('translation', 'cap.sent'),
	    'sender' => Yii::t('translation', 'cap.sender'),
	    'status' => Yii::t('translation', 'cap.status'),
	    'msgtype' => Yii::t('translation', 'cap.msgtype'),
	    'scope' => Yii::t('translation', 'cap.scope'),
	    'category' => Yii::t('translation', 'cap.category'),
	    'event' => Yii::t('translation', 'cap.event'),
	    'responsetype' => Yii::t('translation', 'cap.responsetype'),
	    'urgency' => Yii::t('translation', 'cap.urgency'),
	    'severity' => Yii::t('translation', 'cap.severity'),
	    'certainty' => Yii::t('translation', 'cap.certainty'),
	    'onset' => Yii::t('translation', 'cap.onset'),
	    'expires' => Yii::t('translation', 'cap.expires'),
	    'sendername' => Yii::t('translation', 'cap.sendername'),
	    'headline' => Yii::t('translation', 'cap.headline'),
	    'instruction' => Yii::t('translation', 'cap.instruction'),
	    'description' => Yii::t('translation', 'cap.description'),
	    'contact' => Yii::t('translation', 'cap.contact'),
	    'areadesc' => Yii::t('translation', 'cap.areadesc'),
	    'polygon' => Yii::t('translation', 'cap.polygon'),
	    'sequencecap' => Yii::t('translation', 'cap.sequencecap'),
	    'caphead' => Yii::t('translation', 'cap.caphead'),
	    'language' => Yii::t('translation', 'cap.language'),
	    'polygonwkt' => Yii::t('translation', 'cap.polygonwkt'),
	    'references' => Yii::t('translation', 'cap.references'),
	    'xmlfile' => Yii::t('translation', 'cap.xmlfile'),
	    'hash' => Yii::t('translation', 'cap.hash'),
	    'user_id' => Yii::t('translation', 'cap.user_id'),
	    'type' => Yii::t('translation', 'cap.type'),
	    'parent_id' => Yii::t('translation', 'cap.parent_id'),
	];
    }

}
