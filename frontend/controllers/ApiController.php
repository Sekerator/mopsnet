<?php

namespace frontend\controllers;

use yii\web\Controller;

class ApiController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}