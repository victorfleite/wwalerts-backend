<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "operative.institution".
 *
 * @property integer $id
 * @property string $email
 * @property string $phone
 * @property string $name
 * @property string $country
 * @property string $abbreviation
 * @property string $abbreviation_cap
 * @property string $sender_cap
 * @property string $contact_cap
 * @property string $language_cap
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \app\models\OperativeJurisdiction[] $operativeJurisdictions
 */
class Institution extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'phone', 'name', 'country', 'abbreviation', 'abbreviation_cap', 'sender_cap', 'contact_cap', 'language_cap'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['email', 'phone', 'name', 'country', 'abbreviation'], 'string', 'max' => 255],
            [['abbreviation_cap'], 'string', 'max' => 30],
            [['sender_cap'], 'string', 'max' => 50],
            [['contact_cap'], 'string', 'max' => 150],
            [['language_cap'], 'string', 'max' => 15]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operative.institution';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('translation', 'ID'),
            'email' => Yii::t('translation', 'Email'),
            'phone' => Yii::t('translation', 'Phone'),
            'name' => Yii::t('translation', 'Name'),
            'country' => Yii::t('translation', 'Country'),
            'abbreviation' => Yii::t('translation', 'Abbreviation'),
            'abbreviation_cap' => Yii::t('translation', 'Abbreviation Cap'),
            'sender_cap' => Yii::t('translation', 'Sender Cap'),
            'contact_cap' => Yii::t('translation', 'Contact Cap'),
            'language_cap' => Yii::t('translation', 'Language Cap'),	 
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJurisdictions()
    {
        return $this->hasMany(\backend\models\Jurisdiction::className(), ['institution_id' => 'id']);
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
            ],
        ];
    }
}
