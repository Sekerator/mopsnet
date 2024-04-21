<?php

namespace common\models\magwelt;

use Yii;

/**
 * This is the model class for table "magwelt_chat".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property int|null $status
 *
 * @property MagweltMessages[] $magweltMessages
 * @property MagweltUser $user
 */
class MagweltChat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magwelt_chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => MagweltUser::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'title' => 'Title',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[MagweltMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagweltMessages()
    {
        return $this->hasMany(MagweltMessages::class, ['chat_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(MagweltUser::class, ['id' => 'user_id']);
    }
}
