<?php

namespace common\models\kanban;

use Yii;

/**
 * This is the model class for table "kanban_task".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $description
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property KanbanTaskTag[] $kanbanTaskTags
 * @property User $user
 */
class KanbanTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kanban_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[KanbanTaskTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKanbanTaskTags()
    {
        return $this->hasMany(KanbanTaskTag::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
