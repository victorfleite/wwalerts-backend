<?php

namespace webapp\models\base;

use Yii;

/**
 * This is the base model class for table "public.message".
 *
 * @property integer $id
 * @property string $language
 * @property string $translation
 */
class Message extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['id', 'language'], 'required'],
		[['id'], 'integer'],
		[['translation'], 'string'],
		[['language'], 'string', 'max' => 255]
	];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
	return 'public.message';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'ID'),
	    'language' => Yii::t('translation', 'Language'),
	    'translation' => Yii::t('translation', 'Translation'),
	];
    }

}
