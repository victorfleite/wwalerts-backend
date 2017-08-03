<?php

namespace webapp\modules\communication\models\base;

use Yii;

/**
 * This is the base model class for table "communication.rl_trigger_group".
 *
 * @property integer $trigger_id
 * @property integer $group_id
 */
class RlTriggerGroup extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

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
            [['trigger_id', 'group_id'], 'required'],
            [['trigger_id', 'group_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'communication.rl_trigger_group';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'trigger_id' => Yii::t('translation', 'Trigger ID'),
            'group_id' => Yii::t('translation', 'Group ID'),
        ];
    }
}
