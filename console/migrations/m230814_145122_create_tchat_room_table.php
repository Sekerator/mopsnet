<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tchat_room}}`.
 */
class m230814_145122_create_tchat_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tchat_room}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull()
        ]);

        $this->insert('tchat_room', [
            'created_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tchat_room}}');
    }
}
