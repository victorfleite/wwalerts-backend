<?php

namespace webapp\modules\communication\models\base;

use Yii;

/**
 * This is the base model class for table "communication.trigger".
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $behavior_id
 * @property integer $event_id
 * @property integer $risk_id
 *
 * @property \webapp\modules\communication\models\CommunicationBehavior $behavior
 * @property \webapp\modules\communication\models\CommunicationGroup $group
 * @property \webapp\modules\communication\models\RiskEvent $event
 * @property \webapp\modules\communication\models\RiskRisk $risk
 * @property \webapp\modules\communication\models\CommunicationTriggerFilter[] $communicationTriggerFilters
 */
class Trigger extends \yii\db\ActiveRecord
{

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'behavior',
            'group',
            'event',
            'risk',
            'triggerFilters'
        ];
    }

    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'communication.trigger';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'group_id' => Yii::t('translation', 'Group ID'),
            'behavior_id' => Yii::t('translation', 'Behavior ID'),
            'event_id' => Yii::t('translation', 'Event ID'),
            'risk_id' => Yii::t('translation', 'Risk ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBehavior()
    {
        return $this->hasOne(\webapp\modules\communication\models\Behavior::className(), ['id' => 'behavior_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(\webapp\modules\communication\models\Group::className(), ['id' => 'group_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(\webapp\modules\communication\models\Event::className(), ['id' => 'event_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisk()
    {
        return $this->hasOne(\webapp\modules\communication\models\Risk::className(), ['id' => 'risk_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTriggerFilters()
    {
        return $this->hasMany(\webapp\modules\communication\models\TriggerFilter::className(), ['behavior_id' => 'behavior_id', 'event_id' => 'event_id', 'risk_id' => 'risk_id']);
    }
    }
