<?php

namespace api\modules\magbat\models;

use Yii;

class MagbatUser extends \common\models\magbat\MagbatUser
{
    public function fields()
    {
        return [
            "username",
            "auth_key",
            "created_at",
        ];
    }

    /**
     * Gets query for [[MagbatUserMagicLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagbatUserMagicLists()
    {
        return $this->hasMany(MagbatUserMagicList::class, ['user_id' => 'id']);
    }
}
