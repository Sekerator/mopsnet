<?php

namespace api\modules\tchat\models;

use Yii;

class TchatProfile extends \common\models\tchat\TchatProfile
{
    public function fields()
    {
        return [
            "firstname",
            "lastname",
            "gender",
        ];
    }
}
