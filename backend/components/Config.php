<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use \app\models\Config as ConfigModel;
/**
 * Description of Dumper
 *
 * @author educatux
 */
class Config extends \yii\base\Component {
    
    public $vars = [];
    
    public function setVars(){
        $configs = ConfigModel::find()->all();
            $r = [];
            foreach($configs as $config){
                $r[$config->varname] = $config->value;
            }
            $this->vars = $r;
    }
   
    public function getVar($name){
        if(empty($this->vars)){
            $this->setVars();
        }
        return $this->vars[$name];
    }
    public function getVars(){
        if(empty($this->vars)){
            $this->setVars();
        }
        return $this->vars;
    }
    
}
