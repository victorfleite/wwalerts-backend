<?php

namespace webapp\models\base;

use Yii;

/**
 * This is the base model class for table "public.source_message".
 *
 * @property integer $id
 * @property string $category
 * @property string $message
 */
class SourceMessage extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['message'], 'string'],
		[['category'], 'string', 'max' => 255]
	];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
	return 'public.source_message';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'ID'),
	    'category' => Yii::t('translation', 'Category'),
	    'message' => Yii::t('translation', 'Message'),
	];
    }

}
