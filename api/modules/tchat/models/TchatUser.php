<?php

namespace api\modules\tchat\models;

use Yii;

/**
 * Class TchatUser
 * @package api\modules\tchat\models
 * @property TchatProfile $tchatProfile
 */
class TchatUser extends \common\models\tchat\TchatUser
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
     * Gets query for [[TchatProfiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTchatProfile()
    {
        return $this->hasOne(TchatProfile::class, ['user_id' => 'id']);
    }
}
