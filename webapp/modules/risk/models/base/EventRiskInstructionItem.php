<?php

namespace webapp\modules\risk\models\base;

use Yii;

/**
 * This is the base model class for table "risk.event_risk_instruction_item".
 *
 * @property integer $id
 * @property integer $event_risk_instruction_id
 * @property string $description_i18n
 * @property integer $status
 * @property integer $order
 *
 * @property \webapp\modules\risk\models\RiskEventRiskInstruction $eventRiskInstruction
 */
class EventRiskInstructionItem extends \yii\db\ActiveRecord
{
    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'eventRiskInstruction'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_risk_instruction_id', 'status', 'order'], 'integer'],
            [['description_i18n'], 'required'],
            [['description_i18n'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'risk.event_risk_instruction_item';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'event_risk_instruction_id' => Yii::t('translation', 'Event Risk Instruction ID'),
            'description_i18n' => Yii::t('translation', 'Description I18n'),
            'status' => Yii::t('translation', 'Status'),
            'order' => Yii::t('translation', 'Order'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventRiskInstruction()
    {
        return $this->hasOne(\webapp\modules\risk\models\EventRiskInstruction::className(), ['id' => 'event_risk_instruction_id']);
    }
    }
