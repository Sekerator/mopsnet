<?php

namespace common\models\tchat;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tchat_message".
 *
 * @property int $id
 * @property int $user_id
 * @property int $room_id
 * @property string $message
 * @property int $created_at
 *
 * @property TchatRoom $room
 * @property TchatUser $user
 */
class TchatMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tchat_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'room_id', 'message'], 'required'],
            [['user_id', 'room_id', 'created_at'], 'integer'],
            [['message'], 'string'],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => TchatRoom::class, 'targetAttribute' => ['room_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TchatUser::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
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
            'message' => 'Message',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(TchatRoom::class, ['id' => 'room_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TchatUser::class, ['id' => 'user_id']);
    }
}
