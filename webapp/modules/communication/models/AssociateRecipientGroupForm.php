<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace webapp\modules\communication\models;

/**
 * Description of AssociateRecipientGroupForm
 *
 * @author victor.leite
 */
class AssociateRecipientGroupForm extends \yii\base\Model{

    public $recipients;

    /**
     * @return array the validation rules.
     */
    public function rules() {
	return [
		['recipients', 'safe']
	];
    }
    
       /**
     * @inheritdoc
     */
    public function attributeLabels() {
	return [
	    'recipients' => \Yii::t('translation', 'group.associate_recipients_dualbox_title'),
	];
    }

}
