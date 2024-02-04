<?php

namespace api\modules\tchat\controllers;

use api\modules\tchat\models\TchatUser;
use common\models\tchat\TchatProfile;
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

        $model = TchatUser::find()->where(['username' => $username, 'auth_key' => $auth_key])->one();

        if($model)
            return true;

        return false;
    }

    public function actionLogin($signup = false)
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        $model = TchatUser::find()->where(['username' => $username])->one();

        if($signup)
        {
            $model = new TchatUser();
            if($model->signup($username, $password)) {
                $profile = new TchatProfile();
                $profile->user_id = $model->id;
                $profile->save();
                return $model;
            }
            Yii::info($model->errors);

            return ['error' => "Ошибка при регистрации"];
        }
        else
        {
            if($model->login($password))
                return $model;

            return ['error' => "Неверный пароль"];
        }
    }
}


