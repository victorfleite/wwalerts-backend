<?php

namespace app\models;

use \app\models\base\Institution as BaseInstitution;

/**
 * This is the model class for table "operative.institution".
 */
class Institution extends BaseInstitution {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['name', 'country', 'abbreviation', 'abbreviation_cap', 'sender_cap', 'contact_cap', 'language_cap'], 'required'],
		[['id'], 'integer'],
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
	];
    }

}
