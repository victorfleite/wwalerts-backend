<?php

namespace webapp\modules\communication\models;

use Yii;
use \webapp\modules\communication\models\base\Group as BaseGroup;

/**
 * This is the model class for table "communication.group".
 */
class Group extends BaseGroup implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['name'], 'required'],
		[['status'], 'integer'],
		[['name'], 'string', 'max' => 200],
		[['description'], 'string', 'max' => 100]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'group.id'),
	    'name' => Yii::t('translation', 'group.name'),
	    'description' => Yii::t('translation', 'group.description'),
	    'status' => Yii::t('translation', 'group.status'),
	];
    }

    /**
     * @return Array
     */
    public function getAllRecipientsIds() {
	$recipients = parent::getRecipients()->all();
	$recipientsIds = [];
	if (is_array($recipients)) {
	    foreach ($recipients as $j) {
		$recipientsIds[] = $j->id;
	    }
	}
	return $recipientsIds;
    }

}
