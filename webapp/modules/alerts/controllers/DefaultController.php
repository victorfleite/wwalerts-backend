<?php

namespace app\modules\alerts\controllers;

use yii\web\Controller;

/**
 * Default controller for the `alerts` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
