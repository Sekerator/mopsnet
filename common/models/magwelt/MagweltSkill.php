<?php

namespace common\models\magwelt;

/**
 * This is the model class for table "magwelt_skill".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 *
 * @property MagweltUserSkill[] $magweltUserSkills
 */
class MagweltSkill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magwelt_skill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 63],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[MagweltUserSkills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagweltUserSkills()
    {
        return $this->hasMany(MagweltUserSkill::class, ['skill_id' => 'id']);
    }
}
