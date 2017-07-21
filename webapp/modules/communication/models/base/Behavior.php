<?php

namespace webapp\modules\communication\models\base;

use Yii;

/**
 * This is the base model class for table "communication.behavior".
 *
 * @property integer $id
 * @property string $name
 * @property string $class
 * @property string $params
 *
 * @property \webapp\modules\communication\models\CommunicationTrigger[] $communicationTriggers
 */
class Behavior extends \yii\db\ActiveRecord
{

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'triggers'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['params'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['class'], 'string', 'max' => 300]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'communication.behavior';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'name' => Yii::t('translation', 'Name'),
            'class' => Yii::t('translation', 'Class'),
            'params' => Yii::t('translation', 'Params'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTriggers()
    {
        return $this->hasMany(\webapp\modules\communication\models\Trigger::className(), ['behavior_id' => 'id']);
    }
    }
