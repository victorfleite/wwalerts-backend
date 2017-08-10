<?php

namespace webapp\modules\communication\models\base;

use Yii;

/**
 * This is the base model class for table "communication.trigger_workgroup_filter".
 *
 * @property integer $id
 * @property integer $trigger_id
 * @property integer $workgroup_id
 * @property string $name
 * @property string $geom
 * @property integer $status
 * @property string $description
 */
class TriggerWorkgroupFilter extends \yii\db\ActiveRecord
{

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            ''
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trigger_id', 'workgroup_id', 'name', 'geom'], 'required'],
            [['trigger_id', 'workgroup_id', 'status'], 'integer'],
            [['geom', 'description'], 'string'],
            [['name'], 'string', 'max' => 150],
            [['trigger_id', 'workgroup_id'], 'unique', 'targetAttribute' => ['trigger_id', 'workgroup_id'], 'message' => 'The combination of Trigger ID and Workgroup ID has already been taken.']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'communication.trigger_workgroup_filter';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'trigger_id' => Yii::t('translation', 'Trigger ID'),
            'workgroup_id' => Yii::t('translation', 'Workgroup ID'),
            'name' => Yii::t('translation', 'Name'),
            'geom' => Yii::t('translation', 'Geom'),
            'status' => Yii::t('translation', 'Status'),
            'description' => Yii::t('translation', 'Description'),
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
    public function getWorkgroup() {
	return $this->hasOne(\webapp\modules\operative\models\Workgroup::className(), ['id' => 'workgroup_id']);
    }
}
