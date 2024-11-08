<?php
namespace api\modules\kanban;

use Yii;
use yii\filters\auth\HttpBearerAuth;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'api\modules\kanban\controllers';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        // Добавляем аутентификацию по токену
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'user' => Yii::$app->kanbanUser,
            'except' => ['login']
        ];

        return $behaviors;
    }

    public function init()
    {
        parent::init();
    }
}
