<?php

namespace console\controllers;

use api\modules\magbat\controllers\BattleController;
use api\modules\tchat\controllers\ChatController;
use yii\console\Controller;
use Workerman\Worker;
use Yii;

class WebsocketController extends Controller
{
    public $ports = [
        "magbat" => "4321",
        "tchat" => "2228",
    ];

    public $context = [
        'ssl' => [
            'local_cert'  => 'fullchain.pem',
            'local_pk'    => 'privkey.pem',
            'verify_peer' => false,
        ]
    ];

    public function StartMagbat()
    {
        $users = array();

        $ws_worker = new Worker('websocket://0.0.0.0:' . $this->ports['magbat'], $this->context);

        $ws_worker->transport = 'ssl';

        $ws_worker->onConnect = function ($connection) use (&$users) {
            $users = BattleController::onConnect($connection, $users);
        };

        $ws_worker->onMessage = function ($connection, $data) use (&$users, $ws_worker) {
            BattleController::onMessage(BattleController::findUser($connection, $users), $data, $users, $ws_worker->connections, $connection);
        };

        $ws_worker->onError = function ($connection, $code, $msg) {
            echo "Error: $msg\n";
        };

        $ws_worker->onClose = function ($connection) use (&$users) {
            if(isset($users[$connection->id]->room_id))
            {
                foreach ($users as $user)
                {
                    if($user->room_id == $users[$connection->id]->room_id)
                        $user->connection->close();
                }
            }

            BattleController::closeConnection($users[$connection->id]);
            unset($users[$connection->id]);
        };
    }

    public function StartTChat()
    {
        $users = array();

        $ws_worker = new Worker('websocket://0.0.0.0:' . $this->ports['tchat'], $this->context);

        $ws_worker->transport = 'ssl';

        $ws_worker->onConnect = function ($connection) use (&$users) {
            $users = ChatController::onConnect($connection, $users);
        };

        $ws_worker->onMessage = function ($connection, $data) use (&$users, $ws_worker) {
            ChatController::onMessage(ChatController::findUser($connection, $users), $data, $users, $ws_worker->connections, $connection);
        };

        $ws_worker->onError = function ($connection, $code, $msg) {
            echo "Error: $msg\n";
        };

        $ws_worker->onClose = function ($connection) use (&$users) {
            if(isset($users[$connection->id]->room_id))
            {
                foreach ($users as $user)
                {
                    if($user->room_id == $users[$connection->id]->room_id)
                        $user->connection->close();
                }
            }

            unset($users[$connection->id]);
        };
    }

    public function actionStart()
    {
        $this->StartMagbat();
        $this->StartTChat();
        Worker::runAll();
    }

    public function actionSend()
    {
        return Yii::$app->mailer->compose()
            ->setTo("alidadas70@mail.ru")
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setSubject("Тема")
            ->setTextBody("Тело")
            ->send();
    }
}