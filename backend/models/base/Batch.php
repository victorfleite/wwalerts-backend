<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "local.batch".
 *
 * @property integer $id
 * @property integer $type
 * @property string $file_path
 * @property string $create_at
 * @property string $date_initial_import
 * @property string $date_final_import
 * @property integer $user_id
 * @property string $comment
 *
 * @property \app\models\User $user
 * @property \app\models\LocalCity[] $localCities
 * @property \app\models\LocalCountry[] $localCountries
 * @property \app\models\LocalRegion[] $localRegions
 * @property \app\models\LocalState[] $localStates
 */
class Batch extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'file_path', 'user_id'], 'required'],
            [['type', 'user_id'], 'integer'],
            [['create_at', 'date_initial_import', 'date_final_import'], 'safe'],
            [['file_path'], 'string', 'max' => 255],
            [['comment'], 'string', 'max' => 500]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'local.batch';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'type' => Yii::t('translation', 'Type'),
            'file_path' => Yii::t('translation', 'File Path'),
            'create_at' => Yii::t('translation', 'Create At'),
            'date_initial_import' => Yii::t('translation', 'Date Initial Import'),
            'date_final_import' => Yii::t('translation', 'Date Final Import'),
            'user_id' => Yii::t('translation', 'User ID'),
            'comment' => Yii::t('translation', 'Comment'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(\backend\models\City::className(), ['batch_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(\backend\models\Country::className(), ['batch_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(\backend\models\Region::className(), ['batch_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(\backend\models\State::className(), ['batch_id' => 'id']);
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
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => false,
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
            ],
        ];
    }
}
