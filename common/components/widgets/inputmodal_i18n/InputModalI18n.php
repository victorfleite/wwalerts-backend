<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components\widgets\inputmodal_i18n;

use \yii\helpers\Html;
use \yii\bootstrap\Modal;
use yii\web\JsExpression;

/**
 * Description of InputModalI18n
 *
 * @author victor.leite
 */
class InputModalI18n extends \yii\bootstrap\InputWidget {

    public $field;

    /**
     * @var Model the data model that this widget is associated with.
     */
    public $model;

    /**
     * @var string the model attribute that this widget is associated with.
     */
    public $attribute;

    /**
     * @var string the input name. This must be set if [[model]] and [[attribute]] are not set.
     */
    public $name;

    /**
     * @var string the input value.
     */
    public $value;
    public $modalSize = 'modal-lg';

    /**
     * ids for modals
     * @var type 
     */
    private $_modalId;
    private $_modalHeaderId;

    /**
     *
     * @var string button label 
     */
    public $button_modal_label;
    public $template = "<div class=\"input-group\">{input}\n<span class=\"input-group-btn\">{button}</span></div>";

    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    public function init() {
	InputModalI18nAssets::register($this->getView());
	if (!isset($this->options['id'])) {
	    $this->options['id'] = Html::getInputId($this->model, $this->attribute);
	}
	$this->_modalId = $this->options['id'] . '_modal';
	$this->_modalHeaderId = $this->options['id'] . '_modalHeader';

	$this->getView()->registerJs($this->getJsModal());
	parent::init();
    }

    public function run() {

	Html::addCssClass($this->options, 'form-control');


	Modal::begin([
	    'header' => '<h4 class="modal-title text-center">' . \Yii::t('translation', 'language.modal_key_translation_title') . '</h4>',
	    'footer' => '<button type="button" class="btn btn-default" id="btn-cancel-'.$this->_modalId.'" >' . \Yii::t('translation', 'language.modal_cancel_btn') . '</button>',
	    'headerOptions' => ['id' => $this->_modalHeaderId],
	    'id' => $this->_modalId,
	    'size' => $this->modalSize,
	    //keeps from closing modal with esc key or by clicking out of the modal.
	    // user must click cancel or X to close
	    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
	]);
	echo "<div id='modalContent'>";
	echo "<div class='alert alert-info'>";
	echo "  <strong><i class='fa fa-circle-o-notch fa-spin' style='font-size:24px'></i></strong>  " . \Yii::t('translation', 'language.modal_loading');
	echo "</div>";
	echo "</div>";
	Modal::end();


	$parts = [
	    "{input}" => Html::activeInput('text', $this->model, $this->attribute, $this->options),
	    "{button}" => Html::button($this->button_modal_label, ['value' => \yii\helpers\Url::to(['/language/key-translation']), 'title' => \Yii::t('translation', 'language.modal_key_translation_title'), 'class' => 'showModalButton btn btn-success']),
	    "{button_modal_label}" => $this->button_modal_label,
	];

	return strtr($this->template, $parts);
    }

    private function getJsModal() {

	$js = <<<JS
	$(function () {
	     $('#btn-cancel-{$this->_modalId}').click(function(){
		$('#{$this->_modalId}').modal('toggle');
	     });
	     $(document) . on('click', '.showModalButton', function () {	
		if ($('#{$this->_modalId}').data('bs.modal').isShown) {
		    $('#{$this->_modalId}').find('#modalContent')
		    .load('opaa');
		} else {
		    //if modal isn't open; open it and load content
		    $('#{$this->_modalId}').modal('show')
		    .find('#modalContent')
		    .load($(this).attr('value'));
		}
	    });
	});
JS;
	return new JsExpression($js);
    }

}
