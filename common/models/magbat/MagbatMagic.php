<?php

namespace common\models\magbat;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "magbat_magic".
 *
 * @property int $id
 * @property int $user_id
 * @property int $type_id
 * @property string $title
 * @property int $mp
 * @property int $updated_at
 * @property int $created_at
 *
 * @property MagbatMagicDirection[] $magbatMagicDirections
 * @property MagbatUserMagicList[] $magbatUserMagicLists
 * @property MagbatMagicType $type
 * @property MagbatUser $user
 */
class MagbatMagic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magbat_magic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type_id', 'title', 'mp'], 'required'],
            [['user_id', 'type_id', 'mp', 'updated_at', 'created_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => MagbatUser::class, 'targetAttribute' => ['user_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => MagbatMagicType::class, 'targetAttribute' => ['type_id' => 'id']],
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
            'type_id' => 'Type ID',
            'title' => 'Title',
            'mp' => 'Mp',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * Gets query for [[MagbatMagicDirections]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagbatMagicDirections()
    {
        return $this->hasMany(MagbatMagicDirection::class, ['magic_id' => 'id']);
    }

    /**
     * Gets query for [[MagbatUserMagicLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagbatUserMagicLists()
    {
        return $this->hasMany(MagbatUserMagicList::class, ['magic_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(MagbatMagicType::class, ['id' => 'type_id']);
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
