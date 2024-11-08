<?php

namespace api\modules\kanban\controllers;

use Yii;
use yii\rest\Controller;
use api\modules\kanban\models\User;

class UserController extends Controller
{
    public function actionLogin()
    {
        $username = Yii::$app->request->post('username') ?? null;
        $email = Yii::$app->request->post('email') ?? null;
        $password = Yii::$app->request->post('password')?? null;

        if (($username === null && $email === null) || $password === null)
            return ['code' => 400, 'error' => 'Missing username, email or password'];

        $user = User::find()->where(['username' => $username])->orWhere(['email' => $email])->one();

        if ($user !== null && !$user->validatePassword($password))
            return ['code' => 400, 'error' => 'Invalid username or password'];

        if ($user === null)
        {
            if ($email === null)
                return ['code' => 400, 'error' => 'Missing email'];

            $user = new User();
            $user->username = $username;
            $user->email = $email;
            $user->setPassword($password);
            $user->generateAuthKey();
            if (!$user->save())
                return ['code' => 417, 'error' => 'User not saved'];
        }

        return $user;
    }
}