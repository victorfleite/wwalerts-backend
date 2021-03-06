<?php

namespace webapp\modules\risk\models;

use Yii;
use webapp\modules\risk\models\base\Risk as BaseRisk;

/**
 * This is the model class for table "risk.risk".
 */
class Risk extends BaseRisk implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;
    use \common\components\traits\TranslationTrait;

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['name_i18n', 'color'], 'required'],
		[['created_at', 'updated_at', 'code'], 'safe'],
		[['created_by', 'updated_by', 'order'], 'integer'],
		[['hash'], 'string'],
		[['name_i18n', 'description_i18n'], 'string', 'max' => 300],
		[['code'], 'string', 'max' => 128],
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
	    'code' => Yii::t('translation', 'risk.code'),
	    'order'=> Yii::t('translation', 'risk.order'),
	];
    }

}
