<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "local.city".
 *
 * @property integer $gid
 * @property string $latitude
 * @property string $longitude
 * @property string $id
 * @property string $state_id
 * @property string $name
 * @property string $the_geom_s
 * @property string $geocode
 * @property string $geom
 * @property integer $batch_id
 *
 * @property \app\models\LocalBatch $batch
 */
class City extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude', 'id', 'state_id', 'geocode'], 'number'],
            [['geom'], 'string'],
            [['batch_id'], 'integer'],
            [['name'], 'string', 'max' => 75],
            [['the_geom_s'], 'string', 'max' => 254]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'local.city';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid' => Yii::t('translation', 'Gid'),
            'latitude' => Yii::t('translation', 'Latitude'),
            'longitude' => Yii::t('translation', 'Longitude'),
            'id' => Yii::t('translation', 'ID'),
            'state_id' => Yii::t('translation', 'State ID'),
            'name' => Yii::t('translation', 'Name'),
            'the_geom_s' => Yii::t('translation', 'The Geom S'),
            'geocode' => Yii::t('translation', 'Geocode'),
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
    }
