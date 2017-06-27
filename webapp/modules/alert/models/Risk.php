<?php

namespace webapp\modules\alert\models;

use Yii;
use \app\modules\alert\models\base\Risk as BaseRisk;

/**
 * This is the model class for table "risk.risk".
 */
class Risk extends BaseRisk {

    /**
     * @inheritdoc
     */
    public function rules() {
	return array_replace_recursive(parent::rules(), [
		[['created_at', 'updated_at'], 'safe'],
		[['created_by', 'updated_by'], 'integer'],
		[['hash'], 'string'],
		[['name'], 'string', 'max' => 30],
		[['description'], 'string', 'max' => 500],
		[['i18n'], 'string', 'max' => 300]
	]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'risk.id'),
	    'name' => Yii::t('translation', 'risk.name'),
	    'description' => Yii::t('translation', 'risk.description'),
	    'i18n' => Yii::t('translation', 'risk.i18n'),
	    'hash' => Yii::t('translation', 'risk.hash'),
	];
    }

}
