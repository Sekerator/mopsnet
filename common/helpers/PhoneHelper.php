<?php

namespace common\helpers;

use Yii;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;

class PhoneHelper
{
    public const isOk = "OK";
    public const isError = "ERROR";

    /**
     * @param $phone
     * @param $ip
     * @return \Exception|mixed|InvalidConfigException|Exception|null
     */
    public static function sendCodeByPhoneCall($phone, $ip): ?object
    {
        $client = new Client();

        try {
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl("https://sms.ru/code/call?phone=$phone&ip=$ip&api_id=" . Yii::$app->params['smsApiKey'])
                ->send();
        } catch (InvalidConfigException|Exception $e) {
            return $e;
        }

        if ($response->isOk) {
            return (object)$response->data;
        }

        return null;
    }

    /**
     * @param $phone
     * @param $ip
     * @param $message
     * @return \Exception|mixed|InvalidConfigException|Exception|null
     */
    public static function sendCodeBySms($phone, $ip, $message): ?object
    {
        $client = new Client();

        try {
            $message = str_replace(" ", "+", $message);
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl("https://sms.ru/sms/send?to=$phone&ip=$ip&msg=$message&json=1&api_id=" . Yii::$app->params['smsApiKey'])
                ->send();
        } catch (InvalidConfigException|Exception $e) {
            return $e;
        }

        if ($response->isOk) {
            $data = (object)$response->data;
            foreach ($data->sms as $item)
                return (object)$item;
        }

        return null;
    }

    public static function getCode($item)
    {
        if($item === null || $item->status !== self::isOk)
            return null;

        return $item->code;
    }
}