<?php

namespace common\models\magwelt;

/**
 * This is the model class for table "magwelt_class".
 *
 * @property int $id
 * @property string $title
 *
 * @property MagweltProfile[] $magweltProfiles
 */
class MagweltClass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magwelt_class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 31],
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
        ];
    }

    /**
     * Gets query for [[MagweltProfiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagweltProfiles()
    {
        return $this->hasMany(MagweltProfile::class, ['class_id' => 'id']);
    }
}
