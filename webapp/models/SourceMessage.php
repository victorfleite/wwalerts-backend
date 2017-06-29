<?php

namespace webapp\models;

use Yii;
use \webapp\models\base\SourceMessage as BaseSourceMessage;

/**
 * This is the model class for table "public.source_message".
 */
class SourceMessage extends BaseSourceMessage {

    const CATEGORY = 'translation';

    public function init() {
	parent::init();
	$this->category = SourceMessage::CATEGORY;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['message', 'category'], 'required'],
		[['message'], 'string'],
		[['message', 'category'], 'unique', 'targetAttribute' => ['message']],
		[['category'], 'string', 'max' => 255]
	];
    }

}
