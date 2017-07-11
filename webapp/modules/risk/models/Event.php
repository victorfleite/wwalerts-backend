<?php

namespace webapp\modules\risk\models;

use Yii;
use \webapp\modules\risk\models\base\Event as BaseEvent;

/**
 * This is the model class for table "risk.event".
 */
class Event extends BaseEvent implements \common\components\traits\SimpleStatusInterface {
    
    use \common\components\traits\SimpleStatusTrait;
    
    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['name_i18n', 'status'], 'required'],
		[['created_at', 'updated_at'], 'safe'],
		[['created_by', 'updated_by', 'status'], 'integer'],
		[['hash'], 'string'],
		[['name_i18n', 'description_i18n'], 'string', 'max' => 300]
	];
    }

}
