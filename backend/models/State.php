<?php

namespace app\models;

use \app\models\base\State as BaseState;
use \common\components\behaviors\PolygonBehavior;

/**
 * This is the model class for table "local.state".
 */
class State extends BaseState {

    /**
     * @inheritdoc
     */
    public function rules() {
	return array_replace_recursive(parent::rules(), [
		[['country_id', 'batch_id'], 'integer'],
		[['center_lat', 'center_lon', 'cd_geocodu'], 'number'],
		[['geom'], 'string'],
		[['name'], 'string', 'max' => 254],
		[['abbreviati'], 'string', 'max' => 2],
		[['icon_path'], 'string', 'max' => 200]
	]);
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
	    'geom' => Yii::t('translation', 'state._geom'),
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
	    ]
	]);
    }

}
