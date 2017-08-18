<?php

namespace webapp\modules\alert\models\base;

use Yii;

/**
 * This is the base model class for table "alert.cap".
 *
 * @property integer $id
 * @property integer $alert_id
 * @property integer $institution_id
 * @property integer $event_id
 * @property integer $risk_id
 * @property string $identifier
 * @property string $sent
 * @property string $sender
 * @property string $status
 * @property string $msgtype
 * @property string $scope
 * @property string $category
 * @property string $event
 * @property string $responsetype
 * @property string $urgency
 * @property string $severity
 * @property string $certainty
 * @property string $onset
 * @property string $expires
 * @property string $sendername
 * @property string $headline
 * @property string $instruction
 * @property string $description
 * @property string $contact
 * @property string $areadesc
 * @property string $polygon
 * @property integer $sequencecap
 * @property integer $caphead
 * @property string $language
 * @property string $polygonwkt
 * @property string $references
 * @property string $xmlfile
 * @property string $hash
 * @property integer $user_id
 * @property string $type
 * @property integer $parent_id
 *
 * @property \webapp\modules\alert\models\AlertAlert[] $alertAlerts
 * @property \webapp\modules\alert\models\AlertAlert $alert
 * @property \webapp\modules\alert\models\Cap $parent
 * @property \webapp\modules\alert\models\Cap[] $caps
 * @property \webapp\modules\alert\models\OperativeInstitution $institution
 * @property \webapp\modules\alert\models\User $user
 * @property \webapp\modules\alert\models\RiskEvent $event0
 * @property \webapp\modules\alert\models\RiskRisk $risk
 * @property \webapp\modules\alert\models\AlertCapParameter[] $alertCapParameters
 */
class Cap extends \yii\db\ActiveRecord {

    public function __construct() {
	parent::__construct();
    }

    /**
     * This function helps \mootensai\relation\RelationTrait runs faster
     * @return array relation names of this model
     */
    public function relationNames() {
	return [
	    'alertAlerts',
	    'alert',
	    'parent',
	    'caps',
	    'institution',
	    'user',
	    'event',
	    'risk',
	    'alertCapParameters'
	];
    }

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
    public static function tableName() {
	return 'alert.cap';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'ID'),
	    'alert_id' => Yii::t('translation', 'Alert ID'),
	    'institution_id' => Yii::t('translation', 'Institution ID'),
	    'event_id' => Yii::t('translation', 'Event ID'),
	    'risk_id' => Yii::t('translation', 'Risk ID'),
	    'identifier' => Yii::t('translation', 'Identifier'),
	    'sent' => Yii::t('translation', 'Sent'),
	    'sender' => Yii::t('translation', 'Sender'),
	    'status' => Yii::t('translation', 'Status'),
	    'msgtype' => Yii::t('translation', 'Msgtype'),
	    'scope' => Yii::t('translation', 'Scope'),
	    'category' => Yii::t('translation', 'Category'),
	    'event' => Yii::t('translation', 'Event'),
	    'responsetype' => Yii::t('translation', 'Responsetype'),
	    'urgency' => Yii::t('translation', 'Urgency'),
	    'severity' => Yii::t('translation', 'Severity'),
	    'certainty' => Yii::t('translation', 'Certainty'),
	    'onset' => Yii::t('translation', 'Onset'),
	    'expires' => Yii::t('translation', 'Expires'),
	    'sendername' => Yii::t('translation', 'Sendername'),
	    'headline' => Yii::t('translation', 'Headline'),
	    'instruction' => Yii::t('translation', 'Instruction'),
	    'description' => Yii::t('translation', 'Description'),
	    'contact' => Yii::t('translation', 'Contact'),
	    'areadesc' => Yii::t('translation', 'Areadesc'),
	    'polygon' => Yii::t('translation', 'Polygon'),
	    'sequencecap' => Yii::t('translation', 'Sequencecap'),
	    'caphead' => Yii::t('translation', 'Caphead'),
	    'language' => Yii::t('translation', 'Language'),
	    'polygonwkt' => Yii::t('translation', 'Polygonwkt'),
	    'references' => Yii::t('translation', 'References'),
	    'xmlfile' => Yii::t('translation', 'Xmlfile'),
	    'hash' => Yii::t('translation', 'Hash'),
	    'user_id' => Yii::t('translation', 'User ID'),
	    'type' => Yii::t('translation', 'Type'),
	    'parent_id' => Yii::t('translation', 'Parent ID'),
	];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlert() {
	return $this->hasOne(\webapp\modules\alert\models\Alert::className(), ['id' => 'alert_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapParent() {
	return $this->hasOne(\webapp\modules\alert\models\Cap::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapUniqueChild() {
	return $this->hasMany(\webapp\modules\alert\models\Cap::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitution() {
	return $this->hasOne(\webapp\modules\operative\models\Institution::className(), ['id' => 'institution_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
	return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent() {
	return $this->hasOne(\webapp\modules\risk\models\Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisk() {
	return $this->hasOne(\webapp\modules\risk\models\Risk::className(), ['id' => 'risk_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapParameters() {
	return $this->hasMany(\webapp\modules\alert\models\AlertCapParameter::className(), ['cap_id' => 'id']);
    }

}
