<?php

namespace common\models\kanban;

use Yii;

/**
 * This is the model class for table "kanban_user".
 *
 * @property int $id
 * @property string $username
 * @property string|null $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class KanbanUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kanban_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function findIdentityByAccessToken($token, $type = null): ?KanbanUser
    {
        return static::findOne(['auth_key' => $token]);
    }
}
