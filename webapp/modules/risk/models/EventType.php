<?php

namespace webapp\modules\risk\models;

use Yii;
use \webapp\modules\risk\models\base\EventType as BaseEventType;

/**
 * This is the model class for table "risk.event_type".
 */
class EventType extends BaseEventType implements \common\components\traits\SimpleStatusInterface {

    use \common\components\traits\SimpleStatusTrait;
    use \common\components\traits\TranslationTrait;

    /**
     * @inheritdoc
     */
    public function rules() {
	return [
		[['name_i18n'], 'required'],
		[['status'], 'integer'],
		[['name_i18n', 'description_i18n'], 'string', 'max' => 300],
		[['abbrev'], 'string', 'max' => 16]
	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'id' => Yii::t('translation', 'eventtype.id'),
	    'name_i18n' => Yii::t('translation', 'eventtype.name_I18n'),
	    'description_i18n' => Yii::t('translation', 'eventtype.description_I18n'),
	    'status' => Yii::t('translation', 'eventtype.status'),
	    'abbrev' => Yii::t('translation', 'eventtype.abbrev'),
	];
    }

}
