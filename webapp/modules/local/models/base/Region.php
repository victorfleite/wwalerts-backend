<?php

namespace webapp\modules\local\models\base;

use Yii;

/**
 * This is the base model class for table "local.region".
 *
 * @property integer $gid
 * @property double $id
 * @property string $nm_meso
 * @property string $cd_geocodu
 * @property string $geom
 * @property integer $country_id
 * @property integer $batch_id
 *
 * @property \app\models\LocalBatch $batch
 * @property \app\models\LocalCountry $country
 */
class Region extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['geom'], 'string'],
            [['country_id'], 'required'],
            [['country_id', 'batch_id'], 'integer'],
            [['nm_meso'], 'string', 'max' => 100],
            [['cd_geocodu'], 'string', 'max' => 2]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'local.region';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid' => Yii::t('translation', 'Gid'),
            'nm_meso' => Yii::t('translation', 'Nm Meso'),
            'cd_geocodu' => Yii::t('translation', 'Cd Geocodu'),
            'geom' => Yii::t('translation', 'Geom'),
            'country_id' => Yii::t('translation', 'Country ID'),
            'batch_id' => Yii::t('translation', 'Batch ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatch()
    {
        return $this->hasOne(\webapp\modules\local\models\Batch::className(), ['id' => 'batch_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(\webapp\modules\local\models\Country::className(), ['gid' => 'country_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\RegionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \webapp\modules\local\models\RegionQuery(get_called_class());
    }
}
