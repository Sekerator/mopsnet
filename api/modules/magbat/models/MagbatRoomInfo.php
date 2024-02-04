<?php

namespace api\modules\magbat\models;

use Yii;

class MagbatRoomInfo extends \common\models\magbat\MagbatRoomInfo
{
    public function fields()
    {
        return [
            'user',
            'hp',
            'mp',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(MagbatUser::class, ['id' => 'user_id']);
    }
}
