<?php

namespace api\modules\magwelt\controllers;

use common\models\magwelt\MagweltUser;
use Yii;
use yii\rest\Controller;
use yii\web\ForbiddenHttpException;

class Profile extends Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->request->headers->get('Token-mopsnet') !== Yii::$app->params['apiKey'])
            throw new ForbiddenHttpException('Invalid Authorization Token');

        return parent::beforeAction($action);
    }

    public function actionGetProfiles()
    {
        $json = json_decode(Yii::$app->request->getRawBody());
        $phone = $json->phone ?? null;

        $user = MagweltUser::findForPhone($phone);

        return $user->magweltProfiles;
    }
}