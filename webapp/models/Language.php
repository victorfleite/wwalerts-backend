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
    public $list = ['ar', 'az', 'bg', 'bs', 'ca', 'cs', 'da', 'de', 'el', 'en-US', 'es', 'et', 'fa', 'fi', 'fr', 'he', 'hr', 'hu', 'id', 'it', 'ja', 'ka', 'kk', 'ko', 'lt', 'lv', 'ms', 'nb-NO', 'nl', 'pl', 'pt', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sr', 'sr-Latn', 'sv', 'tg', 'th', 'uk', 'vi', 'zh-CN', 'zh-TW'];
    public $sourceMessages = [];
    public $translations = [];

    public function init() {
	parent::init();
	$this->status = Language::STATUS_ENABLED;
    }

    public function loadProprieties() {
	$this->sourceMessages = SourceMessage::find(['category' => SourceMessage::CATEGORY])->orderBy('message asc')->all();
	foreach ($this->sourceMessages as $sourceMessage) {
	    $message = Message::findOne(['id' => $sourceMessage->id, 'language' => $this->code]);
	    $translation = '';
	    if (!isset($message)) {
		$translation = '';
	    } else {
		$translation = $message->translation;
	    }
	    $this->translations[$sourceMessage->id] = $translation;
	}
    }

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['code', 'status'], 'required'],
		[['status'], 'integer'],
		[['code'], 'string', 'max' => 10],
		[['traslations'], 'safe'],
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

    public function getComboAvailableLanguages() {
	$ar = [];
	$codesAvailable = array_column($this->find()->asArray()->all(), 'code');
	foreach ($this->list as $l) {
	    if (!in_array($l, $codesAvailable)) {
		$ar[$l] = $l;
	    }
	}
	return $ar;
    }

    public function getComboLanguagesCodes() {
	$ar = [];
	foreach ($this->list as $l) {
	    $ar[$l] = $l;
	}
	return $ar;
    }

    /**
     * Return the value of percentage translated
     * @return string
     */
    public function getTranslationPercentage() {

	$sourcesCode = SourceMessage::findAll(['category' => SourceMessage::CATEGORY]);

	$translationNotCompleted = 0;
	$totalSourceMessage = 0;
	if (is_array($sourcesCode)) {
	    foreach ($sourcesCode as $sourceCode) {
		$message = Message::findOne(['id' => $sourceCode->id, 'language' => $this->code]);

		if (isset($message)) {
		    if (trim($message->translation) == '')
			$translationNotCompleted++;
		}else {
		    $translationNotCompleted++;
		}
		$totalSourceMessage++;
	    }
	}

	return round((1 - ($translationNotCompleted / $totalSourceMessage )) * 100, 1);
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

    public static function getMenuLanguageItens() {

	$languages = Language::find()->where(['status' => Language::STATUS_ENABLED])->orderBy('code')->all();
	$menuItens = [];
	if (is_array($languages)) {
	    foreach ($languages as $language) {
		$menuItens[] = ['label' => Yii::t('translation', 'menu.language.' . $language->code), 'url' => ['/site/set-language', 'language' => $language->code]];
	    }
	}

	return $menuItens;
    }

}
