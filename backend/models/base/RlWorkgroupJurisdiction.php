<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "operative.rl_workgroup_jurisdiction".
 *
 * @property integer $jurisdiction_id
 * @property integer $workgroup_id
 *
 * @property \app\models\OperativeJurisdiction $jurisdiction
 * @property \app\models\OperativeWorkgroup $workgroup
 */
class RlWorkgroupJurisdiction extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurisdiction_id', 'workgroup_id'], 'required'],
            [['jurisdiction_id', 'workgroup_id'], 'integer'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operative.rl_workgroup_jurisdiction';
    }

    /**
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jurisdiction_id' => Yii::t('translation', 'Jurisdiction ID'),
            'workgroup_id' => Yii::t('translation', 'Workgroup ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJurisdiction()
    {
        return $this->hasOne(\app\models\Jurisdiction::className(), ['id' => 'jurisdiction_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkgroup()
    {
        return $this->hasOne(\app\models\Workgroup::className(), ['id' => 'workgroup_id']);
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
            ]
        ];
    }
}
