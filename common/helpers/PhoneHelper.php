<?php

namespace common\helpers;

use Yii;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;

class PhoneHelper
{
    /**
     * @param $phone
     * @param $ip
     * @return \Exception|mixed|InvalidConfigException|Exception|null
     */
    public static function sendCodeByPhoneCall($phone, $ip)
    {
        $client = new Client();

        try {
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl("https://sms.ru/code/call?phone=$phone&ip=$ip&api_id=" . Yii::$app->params['smsApiKey'])
                ->send();
        } catch (InvalidConfigException $e) {
            return $e;
        } catch (Exception $e) {
            return $e;
        }

        if ($response->isOk) {
            return $response->data;
        }

        return null;
    }
}