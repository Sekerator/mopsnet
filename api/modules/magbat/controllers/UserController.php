<?php

namespace api\modules\magbat\controllers;

use api\modules\magbat\models\MagbatUser;
use Yii;
use yii\rest\Controller;

class UserController extends Controller
{
    public function actionCheckUserByAuthKey()
    {
        $username = Yii::$app->request->post('username');
        $auth_key = Yii::$app->request->post('auth_key');

        if($auth_key == "")
            return false;

        $model = MagbatUser::find()->where(['username' => $username, 'auth_key' => $auth_key])->one();

        if($model)
            return true;

        return false;
    }

    public function actionLogin()
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        $model = MagbatUser::find()->where(['username' => $username])->one();

        if($model)
        {
            if($model->login($password))
                return $model;

            return ['error' => "Неверный пароль"];
        }
        else
        {
            $model = new MagbatUser();
            if($model->signup($username, $password))
                return $model;

            return ['error' => "Ошибка при регистрации"];
        }
    }
}


