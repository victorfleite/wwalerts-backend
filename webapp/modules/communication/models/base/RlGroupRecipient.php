<?php

namespace webapp\modules\communication\models\base;

use Yii;

/**
 * This is the base model class for table "communication.rl_group_recipient".
 *
 * @property integer $group_id
 * @property integer $recipient_id
 */
class RlGroupRecipient extends \yii\db\ActiveRecord
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
            [['group_id', 'recipient_id'], 'required'],
            [['group_id', 'recipient_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'communication.rl_group_recipient';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => Yii::t('translation', 'Group ID'),
            'recipient_id' => Yii::t('translation', 'Recipient ID'),
        ];
    }
}
