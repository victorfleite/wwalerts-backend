<?php

namespace webapp\modules\communication\models\base;

use Yii;

/**
 * This is the base model class for table "communication.trigger_group_filter".
 *
 * @property integer $trigger_id
 * @property integer $group_id
 * @property string $name
 * @property string $geom
 * @property integer $status
 */
class TriggerGroupFilter extends \yii\db\ActiveRecord {

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
		[['trigger_id', 'group_id', 'name', 'geom'], 'required'],
		[['trigger_id', 'group_id', 'status'], 'integer'],
		[['geom'], 'string'],
		[['name'], 'string', 'max' => 150]
	];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
	return 'communication.trigger_group_filter';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'ID'),
	    'trigger_id' => Yii::t('translation', 'Trigger ID'),
	    'group_id' => Yii::t('translation', 'Group ID'),
	    'name' => Yii::t('translation', 'Name'),
	    'geom' => Yii::t('translation', 'Geom'),
	    'status' => Yii::t('translation', 'Status'),
	];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrigger() {
	return $this->hasOne(\webapp\modules\communication\models\Trigger::className(), ['id' => 'trigger_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup() {
	return $this->hasOne(\webapp\modules\communication\models\Group::className(), ['id' => 'group_id']);
    }

}
