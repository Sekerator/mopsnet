<?php

namespace api\modules\tchat\controllers;

use api\modules\tchat\models\WebSocketUserModel;
use common\models\tchat\TchatRoom;
use Yii;
use yii\rest\Controller;

class ChatController extends Controller
{
    public static function onConnect($connection, &$users)
    {
        $user = new WebSocketUserModel();
        $user->connection = $connection;
        $users[$connection->id] = $user;

        return $users;
    }

    public static function onMessage($from, $data, &$users, $allConnections, $fromConnection)
    {
        error_reporting(E_ALL);

        if($from == null)
            return false;

        $data = json_decode($data);

        call_user_func_array(ChatController::className(). '::' . $data->action, array($data, $from, &$users, $allConnections, $fromConnection));

        return true;
    }

    public static function findUser($connection,  $users)
    {
        foreach ($users as $user)
        {
            if($user->connection == $connection)
                return $user;
        }

        return null;
    }

    public static function sendAll($connections, $message)
    {
        foreach ($connections as $connection)
        {
            $connection->send($message);
        }
    }

    public static function sendAllForRoom($users, $from, $message)
    {
        foreach ($users as $user)
        {
            if($user->room_id == $from->room_id)
                $user->connection->send($message);
        }
    }


}


