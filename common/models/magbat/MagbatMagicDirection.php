<?php

namespace common\models\magbat;

use Yii;

/**
 * This is the model class for table "magbat_magic_direction".
 *
 * @property int $id
 * @property int $magic_id
 * @property float $point
 * @property int $order
 *
 * @property MagbatMagic $magic
 */
class MagbatMagicDirection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magbat_magic_direction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['magic_id', 'point', 'order'], 'required'],
            [['magic_id', 'order'], 'integer'],
            [['point'], 'string'],
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
            'magic_id' => 'Magic ID',
            'point' => 'Point',
            'order' => 'Order',
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
}
