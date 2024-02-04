<?php

namespace api\modules\magbat\controllers;

use yii\rest\Controller;

class CountryController extends Controller
{
    public function actionIndex()
    {
        return "1s";
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


