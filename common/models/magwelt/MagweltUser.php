<?php

namespace common\models\magwelt;

use Yii;

/**
 * This is the model class for table "magwelt_user".
 *
 * @property int $id
 * @property string $username
 * @property string $phone
 * @property int|null $code
 * @property string|null $auth_key
 * @property int|null $attempt_count
 * @property string|null $ip
 * @property int|null $token
 * @property int|null $status
 * @property int|null $created_at
 *
 * @property MagweltChat[] $magweltChats
 */
class MagweltUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magwelt_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'phone'], 'required'],
            [['code', 'attempt_count', 'token', 'status', 'created_at'], 'integer'],
            [['username'], 'string', 'max' => 63],
            [['phone', 'ip'], 'string', 'max' => 31],
            [['auth_key'], 'string', 'max' => 255],
            [['phone'], 'unique'],
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
            'phone' => 'Phone',
            'code' => 'Code',
            'auth_key' => 'Auth Key',
            'attempt_count' => 'Attempt Count',
            'ip' => 'Ip',
            'token' => 'Token',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[MagweltChats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagweltChats()
    {
        return $this->hasMany(MagweltChat::class, ['user_id' => 'id']);
    }
}
