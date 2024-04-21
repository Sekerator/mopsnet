<?php

namespace common\helpers;

use Yii;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;

class ChatGptHelper
{
    /**
     * @param $messages string for format [['role' => 'user', 'content' => $inputText], ['role' => 'assistant', 'content' => $inputText]]
     * @return \Exception|mixed|InvalidConfigException|Exception|null
     */
    public static function sendChatGPTRequest($messages)
    {
        $client = new Client();

        try {
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('https://api.openai.com/v1/chat/completions')
                ->addHeaders(['Authorization' => 'Bearer ' . Yii::$app->params['chatGptApiKey']])
                ->addHeaders(['Content-Type' => 'application/json'])
                ->setContent(json_encode([
                    'model' => 'gpt-3.5-turbo-0125',
                    'messages' => $messages
                ]))
                ->send();
        } catch (InvalidConfigException $e) {
            return $e;
        } catch (Exception $e) {
            return $e;
        }

        if ($response->isOk) {
            return $response->data;
        }

        Yii::info('--------------------------------CHAT GPT-----------------------------------------');
        Yii::info($response->data);
        Yii::info('--------------------------------CHAT GPT-----------------------------------------');

        return null;
    }
}