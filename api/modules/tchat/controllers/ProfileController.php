<?php

namespace api\modules\tchat\controllers;

use api\modules\tchat\models\TchatUser;
use Yii;
use yii\rest\Controller;

class ProfileController extends Controller
{
    public function actionGetProfile()
    {
        $username = Yii::$app->request->post('username');

        $model = TchatUser::find()->where(['username' => $username])->one();

        if($model)
            return $model->tchatProfile;

        return false;
    }

    public function actionSetProfile()
    {
        $username = Yii::$app->request->post('username');
        $firstname = Yii::$app->request->post('firstname');
        $lastname = Yii::$app->request->post('lastname');
        $gender = Yii::$app->request->post('gender');

        $model = TchatUser::find()->where(['username' => $username])->one();
        $profile = $model->tchatProfile;

        if($profile)
        {
            $profile->firstname = $firstname;
            $profile->lastname = $lastname;
            $profile->gender = $gender;
            if($profile->save())
                return $profile;
        }

        return false;
    }
}


