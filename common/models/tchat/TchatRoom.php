<?php

namespace common\models\tchat;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tchat_room".
 *
 * @property int $id
 * @property int $created_at
 *
 * @property TchatMessage[] $tchatMessages
 * @property TchatRoomUser[] $tchatRoomUsers
 */
class TchatRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tchat_room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
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
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[TchatMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTchatMessages()
    {
        return $this->hasMany(TchatMessage::class, ['room_id' => 'id']);
    }

    /**
     * Gets query for [[TchatRoomUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTchatRoomUsers()
    {
        return $this->hasMany(TchatRoomUser::class, ['room_id' => 'id']);
    }
}
