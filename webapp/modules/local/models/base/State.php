<?php

namespace webapp\modules\local\models\base;

use Yii;

/**
 * This is the base model class for table "local.state".
 *
 * @property integer $gid
 * @property string $name
 * @property integer $country_id
 * @property string $center_lat
 * @property string $center_lon
 * @property string $abbreviati
 * @property string $icon_path
 * @property string $cd_geocodu
 * @property string $geom
 * @property integer $batch_id
 *
 * @property \app\models\LocalBatch $batch
 * @property \app\models\LocalCountry $country
 */
class State extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'batch_id'], 'integer'],
            [['center_lat', 'center_lon', 'cd_geocodu'], 'number'],
            [['geom'], 'string'],
            [['name'], 'string', 'max' => 254],
            [['abbreviati'], 'string', 'max' => 2],
            [['icon_path'], 'string', 'max' => 200]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'local.state';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid' => Yii::t('translation', 'Gid'),
            'name' => Yii::t('translation', 'Name'),
            'country_id' => Yii::t('translation', 'Country ID'),
            'center_lat' => Yii::t('translation', 'Center Lat'),
            'center_lon' => Yii::t('translation', 'Center Lon'),
            'abbreviati' => Yii::t('translation', 'Abbreviati'),
            'icon_path' => Yii::t('translation', 'Icon Path'),
            'cd_geocodu' => Yii::t('translation', 'Cd Geocodu'),
            'geom' => Yii::t('translation', 'Geom'),
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
     * @return \app\models\StateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \webapp\modules\local\models\StateQuery(get_called_class());
    }
}
