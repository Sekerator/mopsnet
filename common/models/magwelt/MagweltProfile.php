<?php

namespace common\models\magwelt;

/**
 * This is the model class for table "magwelt_profile".
 *
 * @property int $id
 * @property int $user_id
 * @property int $class_id
 * @property int $race_id
 *
 * @property MagweltClass $class
 * @property MagweltCharacteristic[] $magweltCharacteristics
 * @property MagweltUserSkill[] $magweltUserSkills
 * @property MagweltRace $race
 * @property MagweltUser $user
 */
class MagweltProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magwelt_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'class_id', 'race_id'], 'required'],
            [['user_id', 'class_id', 'race_id'], 'integer'],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => MagweltClass::class, 'targetAttribute' => ['class_id' => 'id']],
            [['race_id'], 'exist', 'skipOnError' => true, 'targetClass' => MagweltRace::class, 'targetAttribute' => ['race_id' => 'id']],
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
            'class_id' => 'Class ID',
            'race_id' => 'Race ID',
        ];
    }

    /**
     * Gets query for [[Class]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(MagweltClass::class, ['id' => 'class_id']);
    }

    /**
     * Gets query for [[MagweltCharacteristics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagweltCharacteristics()
    {
        return $this->hasMany(MagweltCharacteristic::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[MagweltUserSkills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagweltUserSkills()
    {
        return $this->hasMany(MagweltUserSkill::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Race]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(MagweltRace::class, ['id' => 'race_id']);
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
