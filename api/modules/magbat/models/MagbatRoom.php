<?php

namespace api\modules\magbat\models;

use Yii;

class MagbatRoom extends \common\models\magbat\MagbatRoom
{
    public function fields()
    {
        return [
            "info",
            "status",
        ];
    }

    /**
     * Gets query for [[MagbatRoomInfos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInfo()
    {
        return $this->hasMany(MagbatRoomInfo::class, ['room_id' => 'id']);
    }
}
