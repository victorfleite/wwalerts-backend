<?php

namespace app\models;

use \app\models\base\Workgroup as BaseWorkgroup;
use \yii\helpers\ArrayHelper;

/**
 * This is the model class for table "operative.workgroup".
 */
class Workgroup extends BaseWorkgroup {

    /**
     * @inheritdoc
     */
    public function rules() {
	return array_replace_recursive(parent::rules(), [
		[['name'], 'required'],
		[['name'], 'string', 'max' => 150],
		[['description'], 'string', 'max' => 500]
	]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => \Yii::t('translation', 'workgroup.id'),
	    'name' => \Yii::t('translation', 'workgroup.name'),
	    'description' => \Yii::t('translation', 'workgroup.description'),
	    'created_at' => \Yii::t('translation', 'workgroup.created_at'),
	    'updated_at' => \Yii::t('translation', 'workgroup.updated_at'),
	    'created_by' => \Yii::t('translation', 'workgroup.created_by'),
	    'updated_by' => \Yii::t('translation', 'workgroup.updated_by'),
	];
    }

    /**
     * @return Array
     */
    public function getJurisdictionsAsArray() {
	$jurisdictions = parent::getJurisdictions()->asArray()->all();
	return ArrayHelper::map($jurisdictions, 'id', 'name');
    }

    /**
     * @return Array
     */
    public function getUsersAsArray() {
	$users = parent::getUsers()->asArray()->all();
	return ArrayHelper::map($user, 'id', 'name');
    }

}
