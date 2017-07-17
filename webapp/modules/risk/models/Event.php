<?php

namespace webapp\modules\risk\models;

use Yii;
use \webapp\modules\risk\models\base\Event as BaseEvent;
use \common\models\Util;

/**
 * This is the model class for table "risk.event".
 */
class Event extends BaseEvent implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;

    const ICON_PATH = 'images/icones/events/';

    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['name_i18n', 'status'], 'required'],
		[['name_i18n'], 'unique'],
		[['created_at', 'updated_at'], 'safe'],
		[['created_by', 'updated_by', 'status'], 'integer'],
		[['hash'], 'string'],
		[['name_i18n', 'description_i18n'], 'string', 'max' => 300],
		[['imageFile'], 'file', 'skipOnEmpty' => (!$this->isNewRecord) ? true : false],
		[['icon_path'], 'safe']
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
	];
    }

    /**
     * Upload icon
     * @return boolean
     */
    public function upload() {
	if ($this->validate()) {
	    if (!empty($this->imageFile)) {
		$fileName = Util::sanitizeString($this->imageFile->baseName) . '_' . Util::generateHashSha256(6) . '.' . $this->imageFile->extension;
		$this->icon_path = Event::ICON_PATH . strtolower($fileName);
		$this->imageFile->saveAs($this->icon_path);
	    }
	    return true;
	} else {
	    return false;
	}
    }

}
