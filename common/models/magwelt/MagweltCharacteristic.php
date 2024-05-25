<?php

namespace common\models\magwelt;

/**
 * This is the model class for table "magwelt_characteristic".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $str
 * @property int|null $dex
 * @property int|null $con
 * @property int|null $int
 * @property int|null $wis
 *
 * @property MagweltProfile $user
 */
class MagweltCharacteristic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magwelt_characteristic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'str', 'dex', 'con', 'int', 'wis'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => MagweltProfile::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'str' => 'Str',
            'dex' => 'Dex',
            'con' => 'Con',
            'int' => 'Int',
            'wis' => 'Wis',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(MagweltProfile::class, ['id' => 'user_id']);
    }
}
