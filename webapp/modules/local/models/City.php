<?php

namespace webapp\modules\local\models;

use webapp\modules\local\models\base\City as BaseCity;
use \common\components\behaviors\PolygonBehavior;

/**
 * This is the model class for table "local.city".
 */
class City extends BaseCity {

    /**
     * @inheritdoc
     */
    public function rules() {
	return array_replace_recursive(parent::rules(), [
		[['latitude', 'longitude', 'state_id', 'geocode'], 'number'],
		[['geom'], 'string'],
		[['batch_id', 'country_id'], 'integer'],
		[['name'], 'string', 'max' => 75],
		[['the_geom_s'], 'string', 'max' => 254]
	]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'gid' => \Yii::t('translation', 'city.gid'),
	    'latitude' => \Yii::t('translation', 'city.latitude'),
	    'longitude' => \Yii::t('translation', 'city.longitude'),
	    'state_id' => \Yii::t('translation', 'city.state_id'),
	    'name' => \Yii::t('translation', 'city.name'),
	    'the_geom_s' => \Yii::t('translation', 'city.the_geom_s'),
	    'geocode' => \Yii::t('translation', 'city.geocode'),
	    'geom' => \Yii::t('translation', 'city.geom'),
	    'batch_id' => \Yii::t('translation', 'city.batch_id'),
	    'country_id' => \Yii::t('translation', 'city.country_id'),
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
		'pk_name'=>'gid',
	    ]
	]);
    }

}
