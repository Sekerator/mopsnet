<?php

namespace common\models\magbat;

use Yii;

/**
 * This is the model class for table "magbat_magic_type".
 *
 * @property int $id
 * @property string $title
 *
 * @property MagbatMagic[] $magbatMagics
 */
class MagbatMagicType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magbat_magic_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
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
     * Gets query for [[MagbatMagics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMagbatMagics()
    {
        return $this->hasMany(MagbatMagic::class, ['type_id' => 'id']);
    }
}
