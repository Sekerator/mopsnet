<?php

namespace common\models\magwelt;

/**
 * This is the model class for table "magwelt_user_skill".
 *
 * @property int $id
 * @property int $user_id
 * @property int $skill_id
 *
 * @property MagweltSkill $skill
 * @property MagweltProfile $user
 */
class MagweltUserSkill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magwelt_user_skill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'skill_id'], 'required'],
            [['user_id', 'skill_id'], 'integer'],
            [['skill_id'], 'exist', 'skipOnError' => true, 'targetClass' => MagweltSkill::class, 'targetAttribute' => ['skill_id' => 'id']],
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
            'skill_id' => 'Skill ID',
        ];
    }

    /**
     * Gets query for [[Skill]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(MagweltSkill::class, ['id' => 'skill_id']);
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
