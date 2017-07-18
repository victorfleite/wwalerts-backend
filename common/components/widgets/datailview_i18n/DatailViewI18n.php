<?php

namespace common\components\widgets\datailview_i18n;

use yii\base\Widget;
use \Yii;
use yii\helpers\Html;
use \webapp\models\SourceMessage;
use \webapp\models\Language;
use \webapp\models\Message;

/**
 * Description of DatailViewI18n
 *
 * @author victor.leite
 */
class DatailViewI18n extends Widget {

    public $model;
    public $attribute;
    public $template = '<tr><th style="width:30%">{label}</th><td>{value}</td></tr>';
    public $options = ['class' => 'table table-striped table-bordered detail-view'];

    public function init() {
	parent::init();
    }

    /**
     * Renders the detail view.
     * This is the main entry of the whole detail view rendering.
     */
    public function run() {
	$rows = [];
	$i = 0;
	$sourceMessage = SourceMessage::find()->where(['category' => SourceMessage::CATEGORY, 'message' => $this->model->{$this->attribute}])->one();
	if (isset($sourceMessage)) {
	    $rows[] = $this->renderAttribute($this->model->getAttributeLabel($this->attribute) . '<br><span style="color:#8e8e8e">' . $this->model->{$this->attribute} . '</span>', '<strong>' . Yii::t('translation', 'translations') . '</strong>', $i++);
	    $languages = Language::find()->where(['status' => Language::STATUS_ACTIVE])->orderBy('code')->all();

	    if (is_array($languages)) {
		foreach ($languages as $language) {
		    $message = Message::find()->where(['id' => $sourceMessage->id, 'language' => $language->code])->one();
		    if (!isset($message))
			$message = new Message();
		    $rows[] = $this->renderAttribute(Yii::t('translation', 'menu.language.' . $language->code), $message->translation, $i++);
		}
	    }

	    $options = $this->options;
	    echo Html::tag('table', implode("\n", $rows), $options);
	}
    }

    /**
     * Renders a single attribute.
     * @param array $attribute the specification of the attribute to be rendered.
     * @param int $index the zero-based index of the attribute in the [[attributes]] array
     * @return string the rendering result
     */
    protected function renderAttribute($label, $value, $index) {

	return strtr($this->template, [
	    '{label}' => $label,
	    '{value}' => $value,
	]);
    }

}
