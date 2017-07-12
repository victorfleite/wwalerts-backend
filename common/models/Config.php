<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $varname
 * @property string $value
 */
class Config extends \yii\db\ActiveRecord {

    const VARNAME_LANGUAGE_CODE = 'LANGUAGE_CODE';
    const VARNAME_COUNTRY_ID = 'COUNTRY_ID';
    const VARNAME_TIME_OFFSET = 'TIME_OFFSET';
    const VARNAME_MAP_DEFAULT_CENTER_LATITUDE = 'MAP_DEFAULT_CENTER_LATITUDE';
    const VARNAME_MAP_DEFAULT_CENTER_LONGITUDE = 'MAP_DEFAULT_CENTER_LONGITUDE';
    const VARNAME_MAP_DEFULT_ZOOM = 'MAP_DEFULT_ZOOM';
    const VARNAME_JURISDICTION_DEFAULT_LAYER_COLOR = 'JURISDICTION_DEFAULT_LAYER_COLOR';
    const VARNAME_JURISDICTION_DEFAULT_LAYER_OPACITY = 'JURISDICTION_DEFAULT_LAYER_OPACITY';
    const VARNAME_LANGUAGE_REFERENCE_TRANSLATION_CODE = 'LANGUAGE_REFERENCE_TRANSLATION_CODE';

    /**
     * @inheritdoc
     */
    public static function tableName() {
	return 'config';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['varname', 'value'], 'required'],
		[['varname'], 'string', 'max' => 45],
		[['value'], 'string', 'max' => 100],
		[['value'], 'validateValue'],
	];
    }

    public function validateValue($attribute, $params, $validator) {

	switch ($this->varname) {
	    case Config::VARNAME_LANGUAGE_CODE:
		// Nothing		
		break;
	    case Config::VARNAME_COUNTRY_ID:
		$this->validateNumeric($this->$attribute, $attribute);
		break;
	    case Config::VARNAME_TIME_OFFSET:
		$this->validateNumeric($this->$attribute, $attribute);
		break;
	    case Config::VARNAME_MAP_DEFAULT_CENTER_LATITUDE:
		$this->validateNumeric($this->$attribute, $attribute);
		break;
	    case Config::VARNAME_MAP_DEFAULT_CENTER_LONGITUDE:
		$this->validateNumeric($this->$attribute, $attribute);
		break;
	    case Config::VARNAME_MAP_DEFULT_ZOOM:
		$this->validateNumeric($this->$attribute, $attribute);
		break;
	    case Config::VARNAME_JURISDICTION_DEFAULT_LAYER_OPACITY:
		$this->validateNumeric($this->$attribute, $attribute);
		break;
	    case Config::VARNAME_LANGUAGE_REFERENCE_TRANSLATION_CODE:
		// Nothing		
		break;
	    default:
	}
    }

    public function validateNumeric($value, $attribute) {
	if (!is_numeric($value)) {
	    $this->addError($attribute, 'The field must to be a number".');
	}
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'config.id'),
	    'varname' => Yii::t('translation', 'config.varname'),
	    'value' => Yii::t('translation', 'config.value'),
	];
    }

    public function afterSave($insert, $changedAttributes) {
	parent::afterSave($insert, $changedAttributes);
	switch ($this->varname) {
	    case Config::VARNAME_LANGUAGE_CODE:
		// SET DEFAULT LANGUAGE;		
		\webapp\models\Language::setSystemDefaultLanguage($this->value);
		break;
	    default:
	}

	return true;
    }

}
