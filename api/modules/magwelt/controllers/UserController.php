<?php

namespace api\modules\magwelt\controllers;

use common\models\magwelt\MagweltUser;
use Yii;
use common\helpers\PhoneHelper;
use yii\rest\Controller;

class UserController extends Controller
{
    public function beforeAction($action)
    {
        if (!Yii::$app->request->headers->has('token-mopsnet'))
            return 'Not has token';

        if (Yii::$app->request->headers->get('token-mopsnet') !== Yii::$app->params['apiKey'])
            return 'Token is invalid';

        return parent::beforeAction($action);
    }

    public function actionLogin()
    {
        $sendSms = Yii::$app->request->post('sms') ?? null;
        $phone = Yii::$app->request->post('phone') ?? null;

        if ($phone === null)
            return 'Invalid phone';

        $model = MagweltUser::find()->where(['phone' => $phone])->andWhere(['status' => MagweltUser::STATUS_ACTIVE])->one();

        if ($model === null) {
            $model = new MagweltUser();
            $model->phone = $phone;
        }

        if ($sendSms !== null) {
            $code = rand(1000, 9999);
            $codeSender = PhoneHelper::sendCodeBySms($phone, Yii::$app->request->userIP, $code);
        } else
            $codeSender = PhoneHelper::sendCodeByPhoneCall($phone, Yii::$app->request->userIP);

        if ($codeSender === null || $codeSender->status !== PhoneHelper::isOk)
            return 'Error for code send';

//        if ($sendSms === null)
//            $code = $codeSender->code;

        $model->code;

        return PhoneHelper::sendCodeBySms('79057953968', '213.209.148.7', 'Ваш код: 1234');
    }

    public function actionTest()
    {
        return 'test';
    }
}


