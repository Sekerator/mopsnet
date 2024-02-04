<?php

namespace api\modules\v1\controllers;

use yii\rest\Controller;

class CountryController extends Controller
{
    public function actionIndex()
    {
        return "SSS";
    }

    public function actionEcho($slug)
    {
        return $slug;
    }

    public function actionTest()
    {
        return "TTT";
    }
}


