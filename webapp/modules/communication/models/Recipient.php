<?php

namespace webapp\modules\communication\models;

use Yii;
use \webapp\modules\communication\models\base\Recipient as BaseRecipient;

/**
 * This is the model class for table "communication.recipient".
 */
class Recipient extends BaseRecipient implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['email'], 'required'],
		[['email'], 'email'],
		[['status'], 'integer'],
		[['name'], 'string', 'max' => 250],
		[['email'], 'string', 'max' => 200],
		[['phone'], 'number']
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'recipient.id'),
	    'name' => Yii::t('translation', 'recipient.name'),
	    'email' => Yii::t('translation', 'recipient.email'),
	    'phone' => Yii::t('translation', 'recipient.phone'),
	    'status' => Yii::t('translation', 'recipient.status'),
	];
    }

}
