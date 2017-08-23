<?php

namespace webapp\modules\operative\models;

use webapp\modules\operative\models\base\Jurisdiction as BaseJurisdiction;
use \common\components\behaviors\PolygonBehavior;
use \common\components\validators\WktValidator;
use \common\models\Config;

/**
 * This is the model class for table "operative.jurisdiction".
 */
class Jurisdiction extends BaseJurisdiction {

    const REDIS_KEY = 'JURISDICTION_ID_';

    public $wktErrorMessage;

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
		[['geom'], WktValidator::className()],
		[['institution_id'], 'integer'],
		[['color'], 'string', 'max' => 10],
		[['opacity'], 'number'],
		[['description'], 'safe']
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
	    'opacity' => \Yii::t('translation', 'jurisdiction.opacity'),
	    'description' => \Yii::t('translation', 'jurisdiction.description'),
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

    public function beforeDelete() {
	parent::beforeDelete();

	$workgroups = $this->getWorkgroups()->all();
	if (is_array($workgroups) && count($workgroups) > 0) {
	    \Yii::$app->getSession()->setFlash('danger', [
		'type' => 'danger',
		'duration' => 12000,
		'icon' => 'glyphicon glyphicon-exclamation-sign',
		'title' => \Yii::t('translation', 'Notice'),
		'message' => \Yii::t('translation', 'jurisdiction.message_delete_jurisdiction_with_workgroup', ['name' => $this->name]),
		'positonY' => 'top',
		'positonX' => 'left'
	    ]);
	    return false;
	}

	return true;
    }
    /**
     *  Get Redis key for jurisdiction
     * @return type
     */
    public function getRedisKey() {	
	return Jurisdiction::REDIS_KEY . $this->id;
    }

}
