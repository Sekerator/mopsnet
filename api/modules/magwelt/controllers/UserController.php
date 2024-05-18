<?php

namespace api\modules\magwelt\controllers;

use Yii;
use common\helpers\PhoneHelper;
use yii\rest\Controller;

class UserController extends Controller
{
    public function actionLogin()
    {
//        return PhoneHelper::sendCodeByPhoneCall('79057953968', Yii::$app->request->userIP);
//        return PhoneHelper::sendCodeBySms('79057953968', Yii::$app->request->userIP, 'Ваш код: 1234');
        return PhoneHelper::sendCodeBySms('79057953968', '213.209.148.7', 'Ваш код: 1234');
    }
}


