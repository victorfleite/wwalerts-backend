<?php

namespace common\components;

use \common\models\Config as ConfigModel;

/**
 * Description of Config
 *
 * @author victor.leite
 */
class Config extends \yii\base\Component {

    public $vars = [];

    public function setVars() {
	$configs = ConfigModel::find()->all();
	$r = [];
	foreach ($configs as $config) {
	    if(is_numeric($config->value)){
		$r[$config->varname] = floatval($config->value);
	    }else{
		$r[$config->varname] = $config->value;
	    }
	    
	}
	$this->vars = $r;
    }

    public function getVar($name) {
	if (empty($this->vars)) {
	    $this->setVars();
	}
	return $this->vars[$name];
    }

    public function getVars() {
	if (empty($this->vars)) {
	    $this->setVars();
	}
	return $this->vars;
    }

}
