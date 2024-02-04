<?php

namespace console\controllers;

use common\models\magbat\MagbatUser;
use yii\console\Controller;
use yii\helpers\Console;

class MagicbatController extends Controller
{
    public function actionResetAuthKey()
    {
        $count = 0;
        $models = MagbatUser::find()->all();
        $modelCount = count($models);

        foreach ($models as $model) {
            $model->resetAuthKey();
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


