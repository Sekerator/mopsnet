<?php
namespace console\controllers;

use Yii;
use common\models\User;
use yii\console\Controller;

class UserController extends Controller
{
    /**
     * Создает пользователя для API с указанным логином.
     * @param string $username Логин пользователя.
     * @return void
     */
    public function actionCreateUserForApi($username)
    {
        // Проверка, существует ли пользователь с таким логином
        $existingUser = User::findOne(['username' => $username]);
        if ($existingUser) {
            echo "Пользователь с логином '$username' уже существует.\n";
            return;
        }

        // Создание нового пользователя
        $user = new User();
        $user->username = $username;
        $user->auth_key = Yii::$app->security->generateRandomString(32); // Генерация случайного токена
        $user->password_hash = Yii::$app->security->generatePasswordHash('default_password'); // Установите пароль
        $user->email = $username . '@example.com'; // Устанавливаем email (при необходимости)
        $user->status = 10; // Активный статус (можете изменить по необходимости)
        $user->created_at = time();
        $user->updated_at = time();

        if ($user->save()) {
            echo "Пользователь '$username' успешно создан.\n";
            echo "Токен для доступа: " . $user->auth_key . "\n";
        } else {
            echo "Ошибка при создании пользователя:\n";
            print_r($user->errors);
        }
    }
}