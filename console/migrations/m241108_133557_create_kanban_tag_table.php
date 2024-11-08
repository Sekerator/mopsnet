<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kanban_tag}}`.
 */
class m241108_133557_create_kanban_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kanban_tag}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kanban_tag}}');
    }
}
