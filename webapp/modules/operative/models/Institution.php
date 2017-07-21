<?php

namespace webapp\modules\operative\models;

use webapp\modules\operative\models\base\Institution as BaseInstitution;

/**
 * This is the model class for table "operative.institution".
 */
class Institution extends BaseInstitution {

    const PUBLIC_CAP_INACTIVE = 0;
    const PUBLIC_CAP_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['name', 'country', 'abbreviation', 'abbreviation_cap', 'sender_cap', 'contact_cap', 'language_cap', 'public_cap'], 'required'],
		[['id', 'public_cap'], 'integer'],
		[['email', 'phone', 'name', 'country', 'abbreviation'], 'string', 'max' => 255],
		[['abbreviation_cap'], 'string', 'max' => 30],
		[['sender_cap'], 'string', 'max' => 50],
		[['contact_cap'], 'string', 'max' => 150],
		[['language_cap'], 'string', 'max' => 15]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => \Yii::t('translation', 'institution.id'),
	    'email' => \Yii::t('translation', 'institution.email'),
	    'phone' => \Yii::t('translation', 'institution.phone'),
	    'name' => \Yii::t('translation', 'institution.name'),
	    'country' => \Yii::t('translation', 'institution.country'),
	    'abbreviation' => \Yii::t('translation', 'institution.abbreviation'),
	    'abbreviation_cap' => \Yii::t('translation', 'institution.abbreviation_cap'),
	    'sender_cap' => \Yii::t('translation', 'institution.sender_cap'),
	    'contact_cap' => \Yii::t('translation', 'institution.contact_cap'),
	    'language_cap' => \Yii::t('translation', 'institution.language_cap'),	    
	    'public_cap' => \Yii::t('translation', 'institution.public_cap'),
	    'created_at' => \Yii::t('translation', 'institution.created_at'),
	    'updated_at' => \Yii::t('translation', 'institution.updated_at'),
	];
    }

    public function beforeDelete() {
	parent::beforeDelete();

	$jurisdictions = $this->getJurisdictions()->all();
	if (is_array($jurisdictions) && count($jurisdictions) > 0) {
	    \Yii::$app->getSession()->setFlash('danger', [
		'type' => 'danger',
		'duration' => 12000,
		'icon' => 'glyphicon glyphicon-exclamation-sign',
		'title' => \Yii::t('translation', 'Notice'),
		'message' => \Yii::t('translation', 'institution.message_delete_institution_with_jurisdiction', ['name' => $this->name]),
		'positonY' => 'top',
		'positonX' => 'left'
	    ]);
	    return false;
	}

	return true;
    }

    public static function getPublicCapLabel($p) {
	switch ($p) {
	    case Institution::PUBLIC_CAP_ACTIVE:
		return \Yii::t('translation', 'institution.public_cap_active_label');
		break;
	    case Institution::PUBLIC_CAP_INACTIVE:
		return \Yii::t('translation', 'institution.public_cap_inactive_label');
		break;
	    default:
		break;
	}
    }

    public static function getPublicCapCombo() {
	return [
	    Institution::PUBLIC_CAP_ACTIVE => \Yii::t('translation', 'institution.public_cap_active_label'),
	    Institution::PUBLIC_CAP_INACTIVE => \Yii::t('translation', 'institution.public_cap_inactive_label'),
	];
    }

}
