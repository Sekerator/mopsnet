<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magwelt_user}}`.
 */
class m240418_212335_create_magwelt_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%magwelt_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(63)->notNull(),
            'phone' => $this->string(31)->unique()->notNull(),
            'code' => $this->integer(),
            'auth_key' => $this->string(255),
            'attempt_count' => $this->integer()->defaultValue(0),
            'ip' => $this->string(31),
            'token' => $this->integer()->defaultValue(50000),
            'status' => $this->integer(1)->defaultValue(0),
            'created_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%magwelt_user}}');
    }
}
