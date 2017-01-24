<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components\button_check_service_widget;

use app\components\button_check_service_widget\ButtonCheckServiceWidgetAsset;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Json;
use common\models\Writer;

/**
 * Description of ButtonCheckServiceWidget
 *
 * @author educatux
 */
class ButtonCheckServiceWidget extends Widget {

    public $title;
    public $url;
    public $method;
    public $autoClick = false; 
    public $params = array();
    
    public $msg_page_not_founded = 'Page not founded';

    public function init() {
        parent::init();
        ButtonCheckServiceWidgetAsset::register($this->view);
    }

    public function run() {
        $options = ['id' => $this->id, 'class' => "btn btn-default btn-lg"];
        $writer = new Writer();
        echo "<div class='row buttonCheckService'>";
        echo    "<div class='alert' id='".$this->id."_r'>". Html::button($this->title, $options)."&nbsp;&nbsp;<span id='".$this->id."_message'></span></div>";
        echo "</div>";
        $writer->writeln(" $(function(){")
                ->writeln("   $('#" . $this->id . "').click(function(){")
                ->writeln("      $.ajax({ ")
                ->writeln("         url: '".$this->url."',")
                ->writeln("         type: 'GET',")
                ->writeln("         headers: {'Content-Type': 'application/json','Accept': 'application/json'},")
                ->writeln("         data: ".JSON::encode($this->params).",")
                ->writeln("         success: function (result) {")
                ->writeln("               if(result.success == true){")
                ->writeln("                      $('#".$this->id."_message').html('<span class=\"glyphicon glyphicon-ok btn-lg\"></span> '+result.message);")
                ->writeln("                      $('#" .$this->id.'_r' . "').removeClass('alert-danger').addClass('alert-success')")
                ->writeln("               } ")
                ->writeln("               else { ")
                ->writeln("                      $('#".$this->id."_message').html('<span class=\"glyphicon glyphicon-exclamation-sign btn-lg\"></span> '+result.message);")
                ->writeln("                      $('#" .$this->id.'_r' . "').removeClass('alert-success').addClass('alert-danger')")
                ->writeln("               } ")
                ->writeln("         },")
                ->writeln("         statusCode: { 404:function () {")
                ->writeln("                      $('#".$this->id."_message').html('<span class=\"glyphicon glyphicon-exclamation-sign btn-lg\"></span> '+'".$this->msg_page_not_founded."');")
                ->writeln("                      $('#" .$this->id.'_r' . "').removeClass('alert-success').addClass('alert-danger')")
                ->writeln("         }}")
                ->writeln("      }); ")
                ->writeln("   });");
        
        if($this->autoClick) $writer->writeln("$('#" . $this->id . "').trigger( 'click' );");
        $writer->writeln(" })");
        
        $this->view->registerJs($writer->getString(), View::POS_END);
        return "";
    }

}
