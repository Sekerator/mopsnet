<?php

namespace api\modules\magwelt\controllers;

use Yii;
use common\helpers\PhoneHelper;
use yii\rest\Controller;

class UserController extends Controller
{
    public function actionLogin()
    {
        Yii::info(Yii::$app->request->userIP);
        return PhoneHelper::sendCodeByPhoneCall('79057953968', Yii::$app->request->userIP);
    }
}


