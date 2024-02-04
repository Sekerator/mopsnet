<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tchat_user}}`.
 */
class m230814_144659_create_tchat_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tchat_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(127)->unique()->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'auth_key' => $this->string(255)->null(),
            'created_at' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tchat_user}}');
    }
}
