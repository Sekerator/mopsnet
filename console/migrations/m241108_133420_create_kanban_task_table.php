<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kanban_task}}`.
 */
class m241108_133420_create_kanban_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kanban_task}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'status' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createIndex(
            'idx-kanban_task-user_id',
            'kanban_task',
            'user_id'
        );

        $this->addForeignKey(
            'fk-kanban_task-user_id',
            'kanban_task',
            'user_id',
            'user',
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
            'fk-kanban_task-user_id',
            'kanban_task'
        );

        $this->dropIndex(
            'idx-kanban_task-user_id',
            'kanban_task'
        );

        $this->dropTable('{{%kanban_task}}');
    }
}
