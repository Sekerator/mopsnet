<?php

namespace common\models\magwelt;

use Yii;

/**
 * This is the model class for table "magwelt_messages".
 *
 * @property int $id
 * @property int $chat_id
 * @property string $sender
 * @property string $message
 * @property int|null $status
 * @property int|null $created_at
 *
 * @property MagweltChat $chat
 */
class MagweltMessages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magwelt_messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_id', 'sender', 'message'], 'required'],
            [['chat_id', 'status', 'created_at'], 'integer'],
            [['message'], 'string'],
            [['sender'], 'string', 'max' => 31],
            [['chat_id'], 'exist', 'skipOnError' => true, 'targetClass' => MagweltChat::class, 'targetAttribute' => ['chat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chat_id' => 'Chat ID',
            'sender' => 'Sender',
            'message' => 'Message',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Chat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChat()
    {
        return $this->hasOne(MagweltChat::class, ['id' => 'chat_id']);
    }
}
