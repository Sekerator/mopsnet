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
        $json = json_decode(Yii::$app->request->getRawBody());
        $sendSms = $json->sms ?? null;
        $phone = $json->phone ?? null;

        if ($phone === null)
            return ['error' => 'Invalid phone number'];

        $model = MagweltUser::find()->where(['phone' => $phone])->andWhere(['status' => MagweltUser::STATUS_ACTIVE])->one();
        $countModels = MagweltUser::find()->count();

        if ($model === null) {
            $model = new MagweltUser();
            $model->phone = $phone;
            $model->username = 'Player' . $countModels++;
        }

        if ($sendSms !== null) {
            $code = rand(1000, 9999);
            $codeSender = PhoneHelper::sendCodeBySms($phone, Yii::$app->request->userIP, $code);
        } else {
            $codeSender = PhoneHelper::sendCodeByPhoneCall($phone, Yii::$app->request->userIP);
            $code = PhoneHelper::getCode($codeSender);
        }

        if ($codeSender === null || $codeSender->status !== PhoneHelper::isOk)
            return ['error' => 'Error sending SMS or phone call failed'];

        $model->code = $code;

        if ($model->save())
            return true;

        return ['error' => 'Error model saving', $model->errors];;
    }

    public function actionCheckCode()
    {
        $json = json_decode(Yii::$app->request->getRawBody());
        $code = $json->code ?? null;
        $phone = $json->phone ?? null;

        if ($phone === null || $code === null)
            return ['error' => 'Invalid phone or code'];

        $model = MagweltUser::find()->where(['phone' => $phone])->andWhere(['status' => MagweltUser::STATUS_ACTIVE])->one();

        if ($model === null)
            return ['error' => 'User not found'];

        $model->login_attempt += 1;

        if ($model->code === $code) {
            $model->auth_token = Yii::$app->security->generateRandomString();

            if ($model->save())
                return $model;
        }

        $model->save();

        return ['error' => 'Code not true or model not saving', $model->errors];
    }

    public function actionLoginWithToken()
    {
        $json = json_decode(Yii::$app->request->getRawBody());
        $token = $json->token ?? null;
        $phone = $json->phone ?? null;

        if ($phone === null || $token === null)
            return ['error' => 'Invalid phone number or token'];

        $model = MagweltUser::find()->where(['phone' => $phone])
            ->andWhere(['auth_token' => $token])
            ->andWhere(['status' => MagweltUser::STATUS_ACTIVE])
            ->one();

        if ($model === null)
            return ['error' => 'User not found'];

        return $model;
    }
}


