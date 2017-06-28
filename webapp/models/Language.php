<?php

namespace webapp\models;

use Yii;
use \webapp\models\base\Language as BaseLanguage;

/**
 * This is the model class for table "public.language".
 */
class Language extends BaseLanguage {

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    // Yii2 List (vendors/yiisoft/yii2/messages)
    public $list = ['ar', 'az', 'bg', 'bs', 'ca', 'cs', 'da', 'de', 'el', 'es', 'et', 'fa', 'fi', 'fr', 'he', 'hr', 'hu', 'id', 'it', 'ja', 'ka', 'kk', 'ko', 'lt', 'lv', 'ms', 'nb-NO', 'nl', 'pl', 'pt', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sr', 'sr-Latn', 'sv', 'tg', 'th', 'uk', 'vi', 'zh-CN', 'zh-TW'];

    public function init() {
	parent::init();
	$this->status = Language::STATUS_ENABLED;
    }
    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['code', 'status'], 'required'],
		[['status'], 'integer'],
		[['code'], 'string', 'max' => 10]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'language.id'),
	    'code' => Yii::t('translation', 'language.code'),
	    'status' => Yii::t('translation', 'language.status'),
	];
    }

    public function getComboLanguages() {
	$ar = [];
	foreach ($this->list as $l) {
	    $ar[$l] = $l;
	}
	return $ar;
    }

    public static function getStatusLabel($status) {
	switch ($status) {
	    case Language::STATUS_ENABLED:
		return Yii::t('translation', 'language.status_enabled');
		break;
	    case Language::STATUS_DISABLED:
		return Yii::t('translation', 'language.status_disabled');
		break;
	    default:
		break;
	}
    }

    public static function getStatusCombo() {
	return [
	    Language::STATUS_ENABLED => Yii::t('translation', 'language.status_enabled'),
	    Language::STATUS_DISABLED => Yii::t('translation', 'language.status_disabled')
	];
    }

}
