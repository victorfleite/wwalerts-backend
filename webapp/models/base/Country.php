<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "local.country".
 *
 * @property integer $gid
 * @property string $fips
 * @property string $iso2
 * @property string $iso3
 * @property integer $un
 * @property string $name
 * @property integer $area
 * @property string $pop2005
 * @property integer $region
 * @property integer $subregion
 * @property double $lon
 * @property double $lat
 * @property string $geom
 * @property integer $batch_id
 *
 * @property \app\models\LocalBatch $batch
 * @property \app\models\LocalRegion[] $localRegions
 * @property \app\models\LocalState[] $localStates
 */
class Country extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['un', 'area', 'region', 'subregion', 'batch_id'], 'integer'],
            [['pop2005', 'lon', 'lat'], 'number'],
            [['geom'], 'string'],
            [['fips', 'iso2'], 'string', 'max' => 2],
            [['iso3'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 50]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'local.country';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid' => Yii::t('translation', 'Gid'),
            'fips' => Yii::t('translation', 'Fips'),
            'iso2' => Yii::t('translation', 'Iso2'),
            'iso3' => Yii::t('translation', 'Iso3'),
            'un' => Yii::t('translation', 'Un'),
            'name' => Yii::t('translation', 'Name'),
            'area' => Yii::t('translation', 'Area'),
            'pop2005' => Yii::t('translation', 'Pop2005'),
            'region' => Yii::t('translation', 'Region'),
            'subregion' => Yii::t('translation', 'Subregion'),
            'lon' => Yii::t('translation', 'Lon'),
            'lat' => Yii::t('translation', 'Lat'),
            'geom' => Yii::t('translation', 'Geom'),
            'batch_id' => Yii::t('translation', 'Batch ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatch()
    {
        return $this->hasOne(\backend\models\Batch::className(), ['id' => 'batch_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(\backend\models\Region::className(), ['country_id' => 'gid']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(\backend\models\State::className(), ['country_id' => 'gid']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\CountryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\CountryQuery(get_called_class());
    }
}
