<?php

namespace common\models\magbat;

use Yii;

/**
 * This is the model class for table "magbat_room".
 *
 * @property int $id
 * @property int $status
 *
 * @property MagbatRoomInfo[] $magbatRoomInfos
 */
class MagbatRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magbat_room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[MagbatRoomInfos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagbatRoomInfos()
    {
        return $this->hasMany(MagbatRoomInfo::class, ['room_id' => 'id']);
    }
}
