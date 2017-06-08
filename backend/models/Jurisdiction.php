<?php

namespace backend\models;

use \app\models\base\Jurisdiction as BaseJurisdiction;
use \common\components\behaviors\PolygonBehavior;
use \common\models\Config;

/**
 * This is the model class for table "operative.jurisdiction".
 */
class Jurisdiction extends BaseJurisdiction {

    public function init() {
	parent::init();
	$generalVars = \Yii::$app->config->getVars();
	$this->color = $generalVars[Config::VARNAME_JURISDICTION_DEFAULT_LAYER_COLOR];
	$this->opacity = $generalVars[Config::VARNAME_JURISDICTION_DEFAULT_LAYER_OPACITY];
    }
    
    
    /**
     * @inheritdoc
     */
    public function rules() {
	return array_replace_recursive(parent::rules(), [
		[['name', 'geom', 'institution_id', 'color', 'opacity'], 'required'],
		[['name', 'geom'], 'string'],
		[['institution_id'], 'integer'],
		[['color'], 'string', 'max' => 10],
		[['opacity'], 'number'],
	]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => \Yii::t('translation', 'jurisdiction.id'),
	    'name' => \Yii::t('translation', 'jurisdiction.name'),
	    'color' => \Yii::t('translation', 'jurisdiction.color'),
	    'geom' => \Yii::t('translation', 'jurisdiction.geom'),
	    'institution_id' => \Yii::t('translation', 'jurisdiction.institution_id'),
	    'created_at' => \Yii::t('translation', 'jurisdiction.created_at'),
	    'updated_at' => \Yii::t('translation', 'jurisdiction.updated_at'),
	    'created_by' => \Yii::t('translation', 'jurisdiction.created_by'),
	    'updated_by' => \Yii::t('translation', 'jurisdiction.updated_by'),
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
