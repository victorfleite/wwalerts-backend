<?php

namespace webapp\modules\risk\models;

use Yii;
use \webapp\modules\risk\models\base\Event as BaseEvent;
use \common\models\Util;
use \common\models\Config;

/**
 * This is the model class for table "risk.event".
 */
class Event extends BaseEvent implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;
    use \common\components\traits\TranslationTrait;

    const ICON_PATH = 'images/icones/events/';

    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public function rules() {

	$generalVars = \Yii::$app->config->getVars();
	$maxSize = $generalVars[Config::VARNAME_EVENT_ICON_MAX_SIZE];
	$minWidth = $generalVars[Config::VARNAME_EVENT_ICON_MIN_WIDTH];
	$minHeight = $generalVars[Config::VARNAME_EVENT_ICON_MIN_HEIGHT];
	$maxWidth = $generalVars[Config::VARNAME_EVENT_ICON_MAX_WIDTH];
	$maxHeight = $generalVars[Config::VARNAME_EVENT_ICON_MAX_HEIGHT];

	return [
		[['name_i18n', 'status'], 'required'],
		[['name_i18n'], 'unique'],
		[['created_at', 'updated_at'], 'safe'],
		[['created_by', 'updated_by', 'status'], 'integer'],
		[['hash'], 'string'],
		[['name_i18n', 'description_i18n'], 'string', 'max' => 300],
		[['code'], 'string', 'max' => 128],
		[['imageFile', 'icon_path', 'code'], 'safe'],
		[['imageFile'], 'file', 'extensions' => 'png'],
		[['imageFile'], 'file', 'maxSize' => $maxSize],
		['imageFile', 'image', 'extensions' => 'png',
		'minWidth' => $minWidth, 'maxWidth' => $maxWidth,
		'minHeight' => $minHeight, 'maxHeight' => $maxHeight,
	    ],
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'event.id'),
	    'name_i18n' => Yii::t('translation', 'event.name_i18n'),
	    'description_i18n' => Yii::t('translation', 'event.description_i18n'),
	    'hash' => Yii::t('translation', 'event.hash'),
	    'created_at' => Yii::t('translation', 'event.created_at'),
	    'updated_at' => Yii::t('translation', 'event.updated_at'),
	    'created_by' => Yii::t('translation', 'event.created_by'),
	    'updated_by' => Yii::t('translation', 'event.updated_by'),
	    'status' => Yii::t('translation', 'event.status'),
	    'icon_path' => Yii::t('translation', 'event.icon_path'),
	    'code' => Yii::t('translation', 'event.code'),
	];
    }

    /**
     * Upload icon
     * @return boolean
     */
    public function saveImage($image) {
	if (!is_null($image)) {
	    $ext = end((explode(".", $image->name)));
	    // generate a unique file name to prevent duplicate filenames
	    $fileName = Util::sanitizeString($image->baseName) . '_' . Util::generateHashSha256(6) . ".{$ext}";
	    $this->icon_path = Event::ICON_PATH . strtolower($fileName);
	    return $image->saveAs($this->icon_path);
	}
	return true;
    }

}
