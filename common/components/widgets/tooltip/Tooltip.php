<?php

namespace common\components\widgets\tooltip;

use yii\base\Widget;
use yii\web\View;
use yii\helpers\Html;

/**
 * Description of Tooltip
 *
 * @author victor.leite
 */
class Tooltip extends Widget {

    /**
     * Component that will open the tooltip
     * @var type 
     */
    public $component;

    /**
     * Header of popover
     * @var type 
     */
    public $title;

    /**
     * Message that will open on tooltip or popover
     * @var type 
     */
    public $content;

    /**
     * Type of show: tooltip or popover
     * @var type 
     */
    public $toggle = 'tooltip';

    /**
     * Position of tooltip: top, left, button, right
     * @var type 
     */
    public $placement = "top";

    /**
     * 	How tooltip is triggered - click | hover | focus | manual. You may pass multiple triggers; separate them with a space. manual cannot be combined with any other trigger.
     * @var type 
     */
    public $trigger = 'hover';

    /**
     * Tooltip CSS Style
     * @var type 
     */
    public $style = [];

    /**
     * Template of tooltip
     * @var type 
     */
    public $template = '';

    /**
     * 	Insert HTML into the tooltip. If false, jQuery's text method will be used to insert content into the DOM. Use text if you're worried about XSS attacks.
     * @var type 
     */
    public $html = false;

    /**
     * 	Tooltip css class
     * @var type 
     */
    public $cssClass;

    public function init() {
	TooltipAssets::register($this->getView());
	parent::init();
    }

    public function run() {
	$js = <<<SCRIPT
		/* To initialize BS3 tooltips set this below */
		$(function () { 
		    $("[data-toggle='tooltip']").tooltip(); 
		});
		/* To initialize BS3 popovers set this below */
		$(function () { 
		    $("[data-toggle='popover']").popover(); 
		});
SCRIPT;

	// Register tooltip/popover initialization javascript
	$this->getView()->registerJs($js, View::POS_END);

	$options = [
	    'data-toggle' => $this->toggle,
	    'data-title' => $this->title,
	    'data-content' => $this->content,
	    'data-placement' => $this->placement,
	    'data-trigger' => $this->trigger,
	    'data-html' => $this->html,
	    'style' => Html::cssStyleFromArray($this->style),
	    'class' => $this->cssClass,
	];
	if (!empty($this->template)) {

	    $options['data-template'] = $this->template;
	}

	return Html::tag('span', $this->component, $options);
    }

}
