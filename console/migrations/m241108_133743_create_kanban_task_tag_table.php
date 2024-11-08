<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kanban_task_tag}}`.
 */
class m241108_133743_create_kanban_task_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kanban_task_tag}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createIndex(
            'idx-kanban_task_tag-task_id',
            'kanban_task_tag',
            'task_id'
        );

        $this->addForeignKey(
            'fk-kanban_task_tag-task_id',
            'kanban_task_tag',
            'task_id',
            'kanban_task',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-kanban_task_tag-tag_id',
            'kanban_task_tag',
            'tag_id'
        );

        $this->addForeignKey(
            'fk-kanban_task_tag-tag_id',
            'kanban_task_tag',
            'tag_id',
            'kanban_tag',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-kanban_task_tag-task_id',
            'kanban_task_tag'
        );

        $this->dropIndex(
            'idx-kanban_task_tag-task_id',
            'kanban_task_tag'
        );

        $this->dropForeignKey(
            'fk-kanban_task_tag-tag_id',
            'kanban_task_tag'
        );

        $this->dropIndex(
            'idx-kanban_task_tag-tag_id',
            'kanban_task_tag'
        );

        $this->dropTable('{{%kanban_task_tag}}');
    }
}
