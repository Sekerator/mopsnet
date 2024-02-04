<?php

namespace api\modules\magbat\models;

use Yii;

class MagbatMagicDirection extends \common\models\magbat\MagbatMagicDirection
{
    public function fields()
    {
        return [
            "point",
            "order"
        ];
    }
}
