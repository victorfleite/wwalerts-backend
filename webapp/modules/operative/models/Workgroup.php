<?php

namespace webapp\modules\operative\models;

use webapp\modules\operative\models\base\Workgroup as BaseWorkgroup;
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
    public function getAllJurisdictionsIds() {
	$jurisdictions = parent::getJurisdictions()->all();
	$jurisdictionsIds = [];
	if (is_array($jurisdictions)) {
	    foreach ($jurisdictions as $j) {
		$jurisdictionsIds[] = $j->id;
	    }
	}
	return $jurisdictionsIds;
    }

    /**
     * @return Array
     */
    public function getAllUsersIds() {
	$users = parent::getUsers()->all();
	$usersIds = [];
	if (is_array($users)) {
	    foreach ($users as $u) {
		$usersIds[] = $u->id;
	    }
	}
	return $usersIds;
    }

    /**
     * @return Array
     */
    public function getUsersAsArray() {
	$users = parent::getUsers()->asArray()->all();
	return ArrayHelper::map($user, 'id', 'name');
    }

    public function beforeDelete() {
	parent::beforeDelete();

	$transaction = self::getDb()->beginTransaction();
	try {
	    // Delere references
	    $rl = RlWorkgroupJurisdiction::deleteAll(['workgroup_id' => $this->id]);
	    $rl = RlWorkgroupUser::deleteAll(['workgroup_id' => $this->id]);
	    $transaction->commit();
	    
	} catch (\Exception $e) {
	    $transaction->rollBack();
	    throw $e;
	} catch (\Throwable $e) {
	    $transaction->rollBack();
	    throw $e;
	}
	
	return true;
	
    }

}
