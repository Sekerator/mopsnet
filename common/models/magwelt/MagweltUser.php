<?php

namespace common\models\magwelt;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "magwelt_user".
 *
 * @property int $id
 * @property string $username
 * @property string $phone
 * @property string|null $auth_token
 * @property int|null $code
 * @property int $login_attempt
 * @property int $status
 * @property string|null $created_at
 *
 * @property MagweltProfile[] $magweltProfiles
 */
class MagweltUser extends \yii\db\ActiveRecord
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;
    public const STATUS_BANNED = 3;

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
            [['code', 'login_attempt', 'status'], 'integer'],
            [['username', 'phone'], 'string', 'max' => 31],
            [['auth_token'], 'string', 'max' => 63],
            [['created_at'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['phone'], 'unique'],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
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
            'username' => 'Username',
            'phone' => 'Phone',
            'auth_token' => 'Auth Token',
            'code' => 'Code',
            'login_attempt' => 'Login Attempt',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[MagweltProfiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagweltProfiles()
    {
        return $this->hasMany(MagweltProfile::class, ['user_id' => 'id']);
    }

    public static function findForPhone($phone)
    {
        return self::findOne(['phone' => $phone, 'status' => self::STATUS_ACTIVE]);
    }
}
