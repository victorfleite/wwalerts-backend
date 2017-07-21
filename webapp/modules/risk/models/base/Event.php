<?php

namespace webapp\modules\risk\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "risk.event".
 *
 * @property integer $id
 * @property string $name_i18n
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $hash
 * @property integer $status
 * @property string $description_i18n
 *
 * @property \webapp\modules\risk\models\RiskDescriptionEvent[] $riskDescriptionEvents
 */
class Event extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_i18n'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'status'], 'integer'],
            [['hash'], 'string'],
            [['name_i18n', 'description_i18n'], 'string', 'max' => 300]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'risk.event';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'name_i18n' => Yii::t('translation', 'Name I18n'),
            'hash' => Yii::t('translation', 'Hash'),
            'status' => Yii::t('translation', 'Status'),
            'description_i18n' => Yii::t('translation', 'Description I18n'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRiskDescriptionEvents()
    {
        return $this->hasMany(\webapp\modules\risk\models\RiskDescriptionEvent::className(), ['event_id' => 'id']);
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
