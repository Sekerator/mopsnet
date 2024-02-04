<?php

namespace common\models\tchat;

use Yii;

/**
 * This is the model class for table "tchat_profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property int|null $gender
 *
 * @property TchatUser $user
 */
class TchatProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tchat_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'gender'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 63],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TchatUser::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'gender' => 'Gender',
        ];
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
