<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kanban_user}}`.
 */
class m241108_133201_create_kanban_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kanban_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'auth_key' => $this->string(32),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255),
            'email' => $this->string(255)->unique()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kanban_user}}');
    }
}
