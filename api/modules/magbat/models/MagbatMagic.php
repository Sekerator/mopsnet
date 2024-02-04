<?php

namespace api\modules\magbat\models;

use Yii;

class MagbatMagic extends \common\models\magbat\MagbatMagic
{
    public function fields()
    {
        return [
            "id",
            "user",
            "type",
            "sortDirections",
            "title",
            "mp",
            "createdAtDate"
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

    public function getSortDirections()
    {
        return $this->hasMany(MagbatMagicDirection::class, ['magic_id' => 'id'])->orderBy('order');
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(MagbatMagicType::class, ['id' => 'type_id']);
    }

    public function getCreatedAtDate()
    {
        return date("Y-m-d H:i:s", $this->created_at);
    }
}
