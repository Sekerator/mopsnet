<?php

namespace console\controllers;

use common\models\magbat\MagbatUser;
use common\models\tchat\TchatUser;
use yii\console\Controller;
use yii\helpers\Console;

class ResetAuthKeyController extends Controller
{
    public function actionIndex()
    {
        $this->tchatResetAuthKey();
        $this->magbatResetAuthKey();
    }

    public function tchatResetAuthKey()
    {
        $models = TchatUser::find()->all();

        return $this->resetKeyForModels($models);
    }

    public function magbatResetAuthKey()
    {
        $models = MagbatUser::find()->all();

        return $this->resetKeyForModels($models);
    }

    function resetKeyForModels($models)
    {
        $count = 0;
        $modelCount = count($models);

        if ($modelCount == 0)
            return 1;

        foreach ($models as $model) {
            $model->auth_key = null;
            if($model->save())
                $count++;
            else {
                $errors = json_encode($model->errors);
                $this->stdout("$errors\n", Console::BOLD);
            }
        }


        $this->stdout("Успешно сброшено: {$count} из {$modelCount}\n", Console::BOLD);

        if($count == $modelCount)
            return 1;

        return 0;
    }
}


