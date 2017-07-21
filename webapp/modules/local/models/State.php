<?php

namespace webapp\modules\local\models;

use \Yii;
use webapp\modules\local\models\base\State as BaseState;
use \common\components\behaviors\PolygonBehavior;

/**
 * This is the model class for table "local.state".
 */
class State extends BaseState {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['abbreviati', 'name', 'country_id', 'geom'], 'required'],
		[['country_id', 'batch_id'], 'integer'],
		[['center_lat', 'center_lon', 'cd_geocodu'], 'number'],
		[['geom'], 'string'],
		[['geom'], \common\components\validators\WktValidator::className()],
		[['name'], 'string', 'max' => 254],
		[['abbreviati'], 'string', 'max' => 2],
		[['icon_path'], 'string', 'max' => 200]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'gid' => Yii::t('translation', 'state.gid'),
	    'name' => Yii::t('translation', 'state.name'),
	    'country_id' => Yii::t('translation', 'state.country_id'),
	    'center_lat' => Yii::t('translation', 'state.center_lat'),
	    'center_lon' => Yii::t('translation', 'state.center_lon'),
	    'abbreviati' => Yii::t('translation', 'state.abbreviati'),
	    'icon_path' => Yii::t('translation', 'state.icon_path'),
	    'cd_geocodu' => Yii::t('translation', 'state.cd_geocodu'),
	    'geom' => Yii::t('translation', 'state.geom'),
	    'batch_id' => Yii::t('translation', 'state.batch_id'),
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
		'pk_name' => 'gid',
	    ]
	]);
    }

    /**
     * Get Url for Icon of state
     * @return type
     */
    public function getIconPathUrl() {
	return \Yii::$app->request->BaseUrl . '/' . $this->icon_path;
    }

}
