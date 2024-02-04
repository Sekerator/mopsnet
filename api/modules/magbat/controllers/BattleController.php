<?php

namespace api\modules\magbat\controllers;

use api\modules\magbat\models\MagbatRoom;
use api\modules\magbat\models\MagbatRoomInfo;
use api\modules\magbat\models\MagbatUser;
use api\modules\magbat\models\MagbatUserMagicList;
use api\modules\magbat\models\WebSocketUserModel;
use yii\db\StaleObjectException;
use yii\rest\Controller;

class BattleController extends Controller
{
    public function actionGetActiveMagic()
    {
        $username = \Yii::$app->request->post('username');

        $userModel = MagbatUser::find()->where(['username' => $username])->one();
        $enemyUserModel = null;

        $roomInfoModel = $userModel->room;
        $room = MagbatRoom::find()->where(['id' => $roomInfoModel->room_id])->one();
        foreach ($room->magbatRoomInfos as $info) {
            if ($info->user_id != $userModel->id)
                $enemyUserModel = $info->user;
        }

        $enemyUserMagicList = MagbatUserMagicList::find()->where(['user_id' => $enemyUserModel->id])->andWhere(['status' => 1])->all();
        $myUserMagicList = MagbatUserMagicList::find()->where(['user_id' => $userModel->id])->andWhere(['status' => 1])->all();

        if($myUserMagicList)
            return ['myMagic' => $myUserMagicList, 'enemyMagic' => $enemyUserMagicList];

        return false;
    }

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

        call_user_func_array(BattleController::className(). '::' . $data->action, array($data, $from, &$users, $allConnections, $fromConnection));

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

    public static function closeConnection($user)
    {
        if(!isset($user->room_id))
            return false;

        $roomModel = MagbatRoom::find()->where(['id' => $user->room_id])->one();

        if($roomModel) {
            if (!$roomModel->delete())
                return false;
        }

        return true;
    }

    // User Functions

    public static function ConnectRoom($data, $from, &$users, $allConnections, $fromConnection)
    {
        $username = $data->username;
        $userModel = MagbatUser::find()->where(['username' => $username])->one();

        $users[$from->connection->id]->id = $userModel->id;
        $users[$from->connection->id]->username = $userModel->username;

        $roomModel = MagbatRoom::find()->where(['status' => 0])->one();
        if(!$roomModel) {
            $roomModel = new MagbatRoom();
            if ($roomModel->save()) {
                $roomInfoModel = new MagbatRoomInfo();
                $roomInfoModel->user_id = $userModel->id;
                $roomInfoModel->room_id = $roomModel->id;
                if ($roomInfoModel->save())
                    $users[$from->connection->id]->room_id = $roomModel->id;
            }
        }
        else
        {
            $roomInfoModel = new MagbatRoomInfo();
            $roomInfoModel->user_id = $userModel->id;
            $roomInfoModel->room_id = $roomModel->id;
            if ($roomInfoModel->save()) {
                $users[$from->connection->id]->room_id = $roomModel->id;
                $roomModel->status = 1;
                $roomModel->save();
            }
        }

        if($roomModel->status)
            self::sendAllForRoom($users, $from, json_encode(['action' => 'Game Ready']));
        else
            $from->connection->send(json_encode(['action' => 'Room Create']));
    }

    public static function Move($data, $from, &$users, $allConnections, $fromConnection)
    {
        self::sendAllForRoom($users, $from, json_encode($data));
    }

    public static function UseMagic($data, $from, &$users, $allConnections, $fromConnection)
    {
        self::sendAllForRoom($users, $from, json_encode($data));
    }

    public static function Shoot($data, $from, &$users, $allConnections, $fromConnection)
    {
        $username = $data->username;
        $userModel = MagbatUser::find()->where(['username' => $username])->one();

        $roomModel = $userModel->room;
        $roomModel->hp -= 10;
        if($roomModel->save())
        {
            if($userModel->room->hp <= 0) {
                self::sendAllForRoom($users, $from, json_encode(['action' => 'Game End', 'lose' => $username]));
                return;
            }
        }

        self::sendAllForRoom($users, $from, json_encode($data));
    }

    public static function ForIvan($data, $from, &$users, $allConnections, $fromConnection)
    {
        self::sendAll($allConnections, json_encode($data));
    }
}
