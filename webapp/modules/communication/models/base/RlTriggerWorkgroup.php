<?php

namespace webapp\modules\communication\models\base;

use Yii;

/**
 * This is the base model class for table "communication.rl_trigger_workgroup".
 *
 * @property integer $trigger_id
 * @property integer $workgroup_id
 */
class RlTriggerWorkgroup extends \yii\db\ActiveRecord {

    /**
     * This function helps \mootensai\relation\RelationTrait runs faster
     * @return array relation names of this model
     */
    public function relationNames() {
	return [
	    ''
	];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['trigger_id', 'workgroup_id'], 'required'],
		[['trigger_id', 'workgroup_id'], 'integer']
	];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
	return 'communication.rl_trigger_workgroup';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'trigger_id' => Yii::t('translation', 'Trigger ID'),
	    'workgroup_id' => Yii::t('translation', 'Workgroup ID'),
	];
    }

}
