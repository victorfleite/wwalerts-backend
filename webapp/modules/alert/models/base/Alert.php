<?php

namespace webapp\modules\alert\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "alert.alert".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $risk_id
 * @property string $geom
 * @property string $created_at
 * @property string $start
 * @property string $end
 * @property integer $alert_status_id
 * @property string $map_file
 * @property string $hash
 * @property integer $cap_id
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \webapp\modules\alert\models\AlertAlertStatus $alertStatus
 * @property \webapp\modules\alert\models\AlertCap $cap
 * @property \webapp\modules\alert\models\RiskEvent $event
 * @property \webapp\modules\alert\models\RiskRisk $risk
 * @property \webapp\modules\alert\models\AlertAlertHistory[] $alertAlertHistories
 * @property \webapp\modules\alert\models\AlertCap[] $alertCaps
 */
class Alert extends \yii\db\ActiveRecord
{

    public function __construct(){
        parent::__construct(); 
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'alertStatus',
            'cap',
            'event',
            'risk',
            'alertAlertHistories',
            'alertCaps'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'risk_id', 'geom', 'created_at', 'start', 'end', 'alert_status_id'], 'required'],
            [['event_id', 'risk_id', 'alert_status_id', 'cap_id', 'created_by', 'updated_by'], 'integer'],
            [['geom', 'hash'], 'string'],
            [['created_at', 'start', 'end', 'updated_at'], 'safe'],
            [['map_file'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alert.alert';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'event_id' => Yii::t('translation', 'Event ID'),
            'risk_id' => Yii::t('translation', 'Risk ID'),
            'geom' => Yii::t('translation', 'Geom'),
            'start' => Yii::t('translation', 'Start'),
            'end' => Yii::t('translation', 'End'),
            'alert_status_id' => Yii::t('translation', 'Alert Status ID'),
            'map_file' => Yii::t('translation', 'Map File'),
            'hash' => Yii::t('translation', 'Hash'),
            'cap_id' => Yii::t('translation', 'Cap ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlertStatus()
    {
        return $this->hasOne(\webapp\modules\alert\models\AlertStatus::className(), ['id' => 'alert_status_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCap()
    {
        return $this->hasOne(\webapp\modules\alert\models\Cap::className(), ['id' => 'cap_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(\webapp\modules\risk\models\Event::className(), ['id' => 'event_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisk()
    {
        return $this->hasOne(\webapp\modules\risk\models\Risk::className(), ['id' => 'risk_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlertAlertHistories()
    {
        return $this->hasMany(\webapp\modules\alert\models\AlertHistory::className(), ['alert_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlertCaps()
    {
        return $this->hasMany(\webapp\modules\alert\models\Cap::className(), ['alert_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
                'value' => \Yii::$app->user->id,
            ],
        ];
    }
}
