<?php

namespace common\models\magbat;

use Yii;

/**
 * This is the model class for table "magbat_user_magic_list".
 *
 * @property int $id
 * @property int $user_id
 * @property int $magic_id
 * @property int $status
 *
 * @property MagbatMagic $magic
 * @property MagbatUser $user
 */
class MagbatUserMagicList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magbat_user_magic_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'magic_id'], 'required'],
            [['user_id', 'magic_id', 'status'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => MagbatUser::class, 'targetAttribute' => ['user_id' => 'id']],
            [['magic_id'], 'exist', 'skipOnError' => true, 'targetClass' => MagbatMagic::class, 'targetAttribute' => ['magic_id' => 'id']],
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
            'magic_id' => 'Magic ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Magic]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagic()
    {
        return $this->hasOne(MagbatMagic::class, ['id' => 'magic_id']);
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
