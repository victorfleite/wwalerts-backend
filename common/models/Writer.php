<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

/**
 * Description of Writer
 *
 * @author educatux
 */
class Writer {
  
	const DELIMITER  = "\n";
	public $word;
	
	public function __construct($word = ""){
		$this->word = $word;
	}
	
	public function writeln($str){
		$this->word .= $str . self::DELIMITER;
		return $this;
	}
	public function write($str){
		$this->word .= $str;
		return $this;
	}
	public function replace($key, $value){		
		$this->word = str_replace($key, $value, $this->word);
		return $this;
	}	
	
	public function getString(){
		return $this->word;
	}
	
	
	
	
}
