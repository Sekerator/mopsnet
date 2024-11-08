<?php

namespace common\models\kanban;

use Yii;

/**
 * This is the model class for table "kanban_tag".
 *
 * @property int $id
 * @property string $title
 *
 * @property KanbanTaskTag[] $kanbanTaskTags
 */
class KanbanTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kanban_tag';
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
     * Gets query for [[KanbanTaskTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKanbanTaskTags()
    {
        return $this->hasMany(KanbanTaskTag::class, ['tag_id' => 'id']);
    }
}
