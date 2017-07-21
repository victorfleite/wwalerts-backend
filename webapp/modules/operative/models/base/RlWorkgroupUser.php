<?php

namespace webapp\modules\operative\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "operative.rl_workgroup_jurisdiction".
 *
 * @property integer $jurisdiction_id
 * @property integer $workgroup_id
 *
 * @property \app\models\OperativeJurisdiction $jurisdiction
 * @property \app\models\OperativeWorkgroup $workgroup
 */
class RlWorkgroupUser extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['user_id', 'workgroup_id'], 'required'],
		[['user_id', 'workgroup_id'], 'integer']
	];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
	return 'operative.rl_workgroup_user';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'user_id' => Yii::t('translation', 'User ID'),
	    'workgroup_id' => Yii::t('translation', 'Workgroup ID'),
	];
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
    public function getWorkgroup() {
	return $this->hasOne(\webapp\modules\operative\models\Workgroup::className(), ['id' => 'workgroup_id']);
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors() {
	return [
	];
    }

}
