<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $varname
 * @property string $value
 */
class Config extends \yii\db\ActiveRecord {

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
	];
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

}
