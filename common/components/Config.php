<?php

namespace common\components;

use Yii;
use \common\models\Config as ConfigModel;

/**
 * Description of Config
 *
 * @author victor.leite
 */
class Config extends \yii\base\Component {

    const CACHE_KEY_NAME = 'SYSTEM_CONFIG_VARS';

    public $vars = [];

    public function setVars() {
	$configs = ConfigModel::find()->all();
	$r = [];
	foreach ($configs as $config) {
	    if (is_numeric($config->value)) {
		$r[$config->varname] = floatval($config->value);
	    } else {
		$r[$config->varname] = $config->value;
	    }
	}
	$this->vars = $r;
	
	$cache = Yii::$app->cache;
	// Deletes all values from cache.
	//$cache->flush();
	//Save in CACHE
	$cache->set(Config::CACHE_KEY_NAME, $this->vars);
    }

    public function getVar($name) {
	$cache = Yii::$app->cache;
	if (empty($this->vars)) {
	    $data = $cache->get(Config::CACHE_KEY_NAME);
	    if ($data === false) {
		// Set cache data
		$this->setVars();
	    } else {
		//Get from cache
		$this->vars = $data;
	    }
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
