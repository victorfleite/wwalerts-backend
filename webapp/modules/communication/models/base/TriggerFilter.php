<?php

namespace webapp\modules\communication\models\base;

use Yii;

/**
 * This is the base model class for table "communication.trigger_filter".
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $behavior_id
 * @property integer $event_id
 * @property integer $risk_id
 * @property integer $country_id
 * @property integer $region_id
 * @property integer $state_id
 * @property integer $city_id
 *
 * @property \webapp\modules\communication\models\CommunicationGroup $group
 * @property \webapp\modules\communication\models\CommunicationTrigger $behavior
 * @property \webapp\modules\communication\models\LocalCity $city
 * @property \webapp\modules\communication\models\LocalCountry $country
 * @property \webapp\modules\communication\models\LocalRegion $region
 * @property \webapp\modules\communication\models\LocalState $state
 */
class TriggerFilter extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'group',
            'behavior',
            'city',
            'country',
            'region',
            'state'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'behavior_id', 'event_id', 'risk_id', 'country_id', 'region_id', 'state_id', 'city_id'], 'integer'],
            [['behavior_id', 'event_id', 'risk_id'], 'required']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'communication.trigger_filter';
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
            'country_id' => Yii::t('translation', 'Country ID'),
            'region_id' => Yii::t('translation', 'Region ID'),
            'state_id' => Yii::t('translation', 'State ID'),
            'city_id' => Yii::t('translation', 'City ID'),
        ];
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
    public function getBehavior()
    {
        return $this->hasOne(\webapp\modules\communication\models\Trigger::className(), ['behavior_id' => 'behavior_id', 'event_id' => 'event_id', 'risk_id' => 'risk_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(\webapp\modules\local\models\City::className(), ['gid' => 'city_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(\webapp\modules\local\models\LocalCountry::className(), ['gid' => 'country_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(\webapp\modules\local\models\Region::className(), ['gid' => 'region_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(\webapp\modules\local\models\State::className(), ['gid' => 'state_id']);
    }
    }
