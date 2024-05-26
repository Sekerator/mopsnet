<?php

namespace api\modules\magwelt\controllers;

use common\models\magwelt\MagweltUser;
use Yii;
use common\helpers\PhoneHelper;
use yii\rest\Controller;
use yii\web\ForbiddenHttpException;

class UserController extends Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->request->headers->get('Token-mopsnet') !== Yii::$app->params['apiKey'])
            throw new ForbiddenHttpException('Invalid Authorization Token');

        return parent::beforeAction($action);
    }

    public function actionLogin()
    {
        $sendSms = Yii::$app->request->post('sms') ?? null;
        $phone = Yii::$app->request->post('phone') ?? null;

        if ($phone === null)
            return 417;

        $model = MagweltUser::find()->where(['phone' => $phone])->andWhere(['status' => MagweltUser::STATUS_ACTIVE])->one();

        if ($model === null) {
            $model = new MagweltUser();
            $model->phone = $phone;
        }

        if ($sendSms !== null) {
            $code = rand(1000, 9999);
            $codeSender = PhoneHelper::sendCodeBySms($phone, Yii::$app->request->userIP, $code);
        } else {
            $codeSender = PhoneHelper::sendCodeByPhoneCall($phone, Yii::$app->request->userIP);
            $code = PhoneHelper::getCode($codeSender);
        }

        if ($codeSender === null || $codeSender->status !== PhoneHelper::isOk)
            return 417;

        $model->code = $code;

        if ($model->save())
            return true;

        return 417;
    }

    public function actionCheckCode()
    {
        $code = Yii::$app->request->post('code') ?? null;
        $phone = Yii::$app->request->post('phone') ?? null;

        if ($phone === null || $code === null)
            return 417;

        $model = MagweltUser::find()->where(['phone' => $phone])->andWhere(['status' => MagweltUser::STATUS_ACTIVE])->one();

        if ($model === null)
            return 417;

        $model->login_attempt += 1;

        if ($model->code === $code) {
            $model->auth_token = Yii::$app->security->generateRandomString();

            if ($model->save())
                return $model;
        }

        $model->save();

        return 417;
    }

    public function actionLoginWithToken()
    {
        $token = Yii::$app->request->post('token') ?? null;
        $phone = Yii::$app->request->post('phone') ?? null;

        if ($phone === null || $token === null)
            return 417;

        $model = MagweltUser::find()->where(['phone' => $phone])
            ->andWhere(['auth_token' => $token])
            ->andWhere(['status' => MagweltUser::STATUS_ACTIVE])
            ->one();

        if ($model === null)
            return 417;

        return $model;
    }
}


