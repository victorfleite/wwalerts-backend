<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components\widgets;

use \yii\helpers\Html;

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
    /**
     *
     * @var string button label 
     */
    public $button_modal_label;
    
    public $template = "<div class=\"input-group\">{input}\n<span class=\"input-group-btn\"><button class=\"btn btn-success\" type=\"button\">{button_modal_label}</button></span>{modal}</div>";

    
    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    public function init() {
	parent::init();
    }

    public function run() {

	Html::addCssClass($this->options, 'form-control');
	
	$parts = [ 
		"{input}" => Html::activeInput('text', $this->model, $this->attribute, $this->options),
		"{button_modal_label}" => $this->button_modal_label,
		"{modal}" => 'modal'
	];
	
	return strtr($this->template, $parts );
    }

}
