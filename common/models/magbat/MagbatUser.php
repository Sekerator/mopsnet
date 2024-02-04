<?php

namespace common\models\magbat;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "magbat_user".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string|null $auth_key
 * @property int $created_at
 *
 * @property MagbatMagic[] $magbatMagics
 * @property MagbatUserMagicList[] $magbatUserMagicLists
 * @property MagbatRoomInfo[] $room
 */
class MagbatUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magbat_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash'], 'required'],
            [['created_at'], 'integer'],
            [['username'], 'string', 'max' => 127],
            [['password_hash', 'auth_key'], 'string', 'max' => 255],
            [['username'], 'unique'],
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
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
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
     * Gets query for [[MagbatMagics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagbatMagics()
    {
        return $this->hasMany(MagbatMagic::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[MagbatRoomInfo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(MagbatRoomInfo::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[MagbatUserMagicLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagbatUserMagicLists()
    {
        return $this->hasMany(MagbatUserMagicList::class, ['user_id' => 'id']);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function login($password)
    {
        if($this->validatePassword($password))
        {
            $this->generateAuthKey();

            if($this->save())
                return true;
        }

        return false;
    }

    public function signup($username, $password)
    {
        $this->username = $username;
        $this->setPassword($password);
        $this->generateAuthKey();

        if($this->save())
            return true;

        return false;
    }
}
