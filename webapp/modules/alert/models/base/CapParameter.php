<?php

namespace webapp\modules\alert\models\base;

use Yii;

/**
 * This is the base model class for table "alert.cap_parameter".
 *
 * @property integer $cap_id
 * @property string $key
 * @property string $value
 *
 * @property \webapp\modules\alert\models\AlertCap $cap
 */
class CapParameter extends \yii\db\ActiveRecord {

    public function __construct() {
	parent::__construct();
    }

    /**
     * This function helps \mootensai\relation\RelationTrait runs faster
     * @return array relation names of this model
     */
    public function relationNames() {
	return [
	    'cap'
	];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['cap_id', 'key'], 'required'],
		[['cap_id'], 'integer'],
		[['value'], 'string'],
		[['key'], 'string', 'max' => 50]
	];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
	return 'alert.cap_parameter';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'cap_id' => Yii::t('translation', 'Cap ID'),
	    'key' => Yii::t('translation', 'Key'),
	    'value' => Yii::t('translation', 'Value'),
	];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCap() {
	return $this->hasOne(\webapp\modules\alert\models\Cap::className(), ['id' => 'cap_id']);
    }

}
