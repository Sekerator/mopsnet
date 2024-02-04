<?php

namespace common\models\magbat;

use Yii;

/**
 * This is the model class for table "magbat_room_info".
 *
 * @property int $id
 * @property int $user_id
 * @property int $room_id
 * @property int $hp
 * @property int $mp
 *
 * @property MagbatRoom $room
 * @property MagbatUser $user
 */
class MagbatRoomInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magbat_room_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'room_id'], 'required'],
            [['user_id', 'room_id', 'hp', 'mp'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => MagbatUser::class, 'targetAttribute' => ['user_id' => 'id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => MagbatRoom::class, 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'room_id' => 'Room ID',
            'hp' => 'Hp',
            'mp' => 'Mp',
        ];
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(MagbatRoom::class, ['id' => 'room_id']);
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
