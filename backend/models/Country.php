<?php

namespace backend\models;

use \Yii;
use \app\models\base\Country as BaseCountry;
use \common\components\behaviors\PolygonBehavior;

/**
 * This is the model class for table "local.country".
 */
class Country extends BaseCountry {

    /**
     * @inheritdoc
     */
    public function rules() {
	return array_replace_recursive(parent::rules(), [
		[['un', 'area', 'region', 'subregion', 'batch_id'], 'integer'],
		[['pop2005', 'lon', 'lat'], 'number'],
		[['geom'], 'string'],
		[['fips', 'iso2'], 'string', 'max' => 2],
		[['iso3'], 'string', 'max' => 3],
		[['name'], 'string', 'max' => 50]
	]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'gid' => Yii::t('translation', 'country.gid'),
	    'fips' => Yii::t('translation', 'country.fips'),
	    'iso2' => Yii::t('translation', 'country.iso2'),
	    'iso3' => Yii::t('translation', 'country.iso3'),
	    'un' => Yii::t('translation', 'country.un'),
	    'name' => Yii::t('translation', 'country.name'),
	    'area' => Yii::t('translation', 'country.area'),
	    'pop2005' => Yii::t('translation', 'country.pop2005'),
	    'region' => Yii::t('translation', 'country.region'),
	    'subregion' => Yii::t('translation', 'country.subregion'),
	    'lon' => Yii::t('translation', 'country.lon'),
	    'lat' => Yii::t('translation', 'country.lat'),
	    'geom' => Yii::t('translation', 'country.geom'),
	    'batch_id' => Yii::t('translation', 'country.batch_id'),
	];
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors() {
	return array_merge(parent::behaviors(), [
	    'geometry' => [
		'class' => PolygonBehavior::className(),
		'attribute' => 'geom',
		'type' => PolygonBehavior::GEOMETRY_POLYGON,
	    ]
	]);
    }

}
