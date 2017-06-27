<?php

namespace webapp\modules\alert\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "risk.risk".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $i18n
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $hash
 */
class Risk extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['created_at', 'updated_at'], 'safe'],
		[['created_by', 'updated_by'], 'integer'],
		[['hash'], 'string'],
		[['name'], 'string', 'max' => 30],
		[['description'], 'string', 'max' => 500],
		[['i18n'], 'string', 'max' => 300]
	];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
	return 'alert.risk';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'ID'),
	    'name' => Yii::t('translation', 'Name'),
	    'description' => Yii::t('translation', 'Description'),
	    'i18n' => Yii::t('translation', 'I18n'),
	    'hash' => Yii::t('translation', 'Hash'),
	];
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors() {
	return [
	    'timestamp' => [
		'class' => TimestampBehavior::className(),
		'createdAtAttribute' => 'created_at',
		'updatedAtAttribute' => 'updated_at',
		'value' => new \yii\db\Expression('NOW()'),
	    ],
	    'blameable' => [
		'class' => BlameableBehavior::className(),
		'createdByAttribute' => 'created_by',
		'updatedByAttribute' => 'updated_by',
	    ]
	];
    }

}
