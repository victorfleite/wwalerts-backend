<?php

namespace webapp\models;

use \webapp\models\base\Message as BaseMessage;

/**
 * This is the model class for table "public.message".
 */
class Message extends BaseMessage {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['language'], 'required'],
		[['translation'], 'string'],
		[['language'], 'string', 'max' => 255]
	];
    }

}
