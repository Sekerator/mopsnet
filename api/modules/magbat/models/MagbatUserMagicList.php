<?php

namespace api\modules\magbat\models;

use Yii;

class MagbatUserMagicList extends \common\models\magbat\MagbatUserMagicList
{
    public function fields()
    {
        return [
            "magic",
            "status"
        ];
    }

    /**
     * Gets query for [[Magic]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagic()
    {
        return $this->hasOne(MagbatMagic::class, ['id' => 'magic_id']);
    }
}
