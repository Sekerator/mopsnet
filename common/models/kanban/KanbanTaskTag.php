<?php

namespace common\models\kanban;

use Yii;

/**
 * This is the model class for table "kanban_task_tag".
 *
 * @property int $id
 * @property int $task_id
 * @property int $tag_id
 *
 * @property KanbanTag $tag
 * @property KanbanTask $task
 */
class KanbanTaskTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kanban_task_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'tag_id'], 'required'],
            [['task_id', 'tag_id'], 'integer'],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => KanbanTag::class, 'targetAttribute' => ['tag_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => KanbanTask::class, 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(KanbanTag::class, ['id' => 'tag_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(KanbanTask::class, ['id' => 'task_id']);
    }
}
