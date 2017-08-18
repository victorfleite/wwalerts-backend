<?php

namespace webapp\modules\alert\models\base;

use Yii;

/**
 * This is the base model class for table "alert.alert_history".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $description_i18n
 * @property integer $user_id
 * @property integer $alert_id
 * @property string $params
 *
 * @property \webapp\modules\alert\models\AlertAlert $alert
 * @property \webapp\modules\alert\models\User $user
 */
class AlertHistory extends \yii\db\ActiveRecord {

    public function __construct() {
	parent::__construct();
    }

    /**
     * This function helps \mootensai\relation\RelationTrait runs faster
     * @return array relation names of this model
     */
    public function relationNames() {
	return [
	    'alert',
	    'user'
	];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['created_at', 'user_id', 'alert_id'], 'required'],
		[['created_at'], 'safe'],
		[['description_i18n', 'params'], 'string'],
		[['user_id', 'alert_id'], 'integer']
	];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
	return 'alert.alert_history';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'ID'),
	    'description_i18n' => Yii::t('translation', 'Description I18n'),
	    'user_id' => Yii::t('translation', 'User ID'),
	    'alert_id' => Yii::t('translation', 'Alert ID'),
	    'params' => Yii::t('translation', 'Params'),
	];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlert() {
	return $this->hasOne(\webapp\modules\alert\models\Alert::className(), ['id' => 'alert_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
	return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }

}
