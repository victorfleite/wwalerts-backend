<?php

namespace webapp\models;

use Yii;
use \webapp\models\base\Language as BaseLanguage;

/**
 * This is the model class for table "public.language".
 */
class Language extends BaseLanguage implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;

    const ENGLISH_TRANSLATION_CODE = 'en-US';

    // Yii2 List (vendors/yiisoft/yii2/messages)
    public $list = ['ar', 'az', 'bg', 'bs', 'ca', 'cs', 'da', 'de', 'el', 'en-US', 'es', 'et', 'fa', 'fi', 'fr', 'he', 'hr', 'hu', 'id', 'it', 'ja', 'ka', 'kk', 'ko', 'lt', 'lv', 'ms', 'nb-NO', 'nl', 'pl', 'pt', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sr', 'sr-Latn', 'sv', 'tg', 'th', 'uk', 'vi', 'zh-CN', 'zh-TW'];
    public $sourceMessages = [];
    public $translations = [];

    public function init() {
	parent::init();
	$this->status = Language::STATUS_ACTIVE;
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
   

    public static function getMenuLanguageItens() {

	$languages = Language::find()->where(['status' => Language::STATUS_ACTIVE])->orderBy('code')->all();
	$menuItens = [];
	if (is_array($languages)) {
	    foreach ($languages as $language) {
		$menuItens[] = ['label' => Yii::t('translation', 'language.' . $language->code), 'url' => ['/site/set-language', 'language' => $language->code]];
	    }
	}

	return $menuItens;
    }

    /**
     * Set The defalt language of the system.
     * @param type $languageCode
     */
    public static function setSystemDefaultLanguage($languageCode) {
	// get the cookie collection (yii\web\CookieCollection) from the "response" component
	$cookies = Yii::$app->response->cookies;
	// add a new cookie to the response to be sent
	$cookies->add(new \yii\web\Cookie([
	    'name' => 'language',
	    'value' => $languageCode,
	]));
	// Set the language code on system
	\Yii::$app->language = $languageCode;

	// Create the language on system.. if not exists;
	$language = Language::find()->where(['code' => $languageCode])->one();
	if (!isset($language)) {
	    // Save Language
	    $language = new Language();
	    $language->code = $languageCode;
	    $language->status = Language::STATUS_ACTIVE;
	    $language->save();
	    // Throw flash message
	    $link = \yii\helpers\Html::a('link', \yii\helpers\Url::toRoute(['/language/edit-messages', 'code' => $languageCode]));
	    \Yii::$app->getSession()->setFlash('success', [
		'type' => 'success',
		'duration' => 12000,
		'icon' => 'glyphicon glyphicon-ok-sign',
		'title' => \Yii::t('translation', 'Info'),
		'message' => "New language was created. To translate access the {$link}. ",
		'positonY' => 'top',
		'positonX' => 'left'
	    ]);
	}
    }

}
