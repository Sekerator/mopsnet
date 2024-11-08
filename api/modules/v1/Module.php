<?php
namespace api\modules\v1;

use yii\filters\auth\HttpBearerAuth;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'api\modules\v1\controllers';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        // Добавляем аутентификацию по токену
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];

        return $behaviors;
    }

    public function init()
    {
        parent::init();
    }
}
