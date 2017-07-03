<?php

namespace webapp\modules\alert\models;

use Yii;
use webapp\modules\alert\models\base\Risk as BaseRisk;

/**
 * This is the model class for table "risk.risk".
 */
class Risk extends BaseRisk {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['name_i18n', 'color'], 'required'],
		[['created_at', 'updated_at'], 'safe'],
		[['created_by', 'updated_by'], 'integer'],
		[['hash'], 'string'],
		[['name_i18n', 'description_i18n'], 'string', 'max' => 300]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'risk.id'),
	    'name_i18n' => Yii::t('translation', 'risk.name_i18n'),
	    'description_i18n' => Yii::t('translation', 'risk.description_i18n'),
	    'hash' => Yii::t('translation', 'risk.hash'),
	    'color' => Yii::t('translation', 'risk.color'),
	    'created_at' => Yii::t('translation', 'risk.created_at'),
	    'updated_at' => Yii::t('translation', 'risk.updated_at'),
	    'created_by' => Yii::t('translation', 'risk.created_by'),
	    'updated_by' => Yii::t('translation', 'risk.updated_by'),
	];
    }

}
