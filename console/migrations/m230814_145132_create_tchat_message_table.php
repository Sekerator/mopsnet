<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tchat_message}}`.
 */
class m230814_145132_create_tchat_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tchat_message}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'room_id' => $this->integer()->notNull(),
            'message' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-tchat_message-user_id',
            'tchat_message',
            'user_id'
        );

        $this->addForeignKey(
            'fk-tchat_message-user_id',
            'tchat_message',
            'user_id',
            'tchat_user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-tchat_message-room_id',
            'tchat_message',
            'room_id'
        );

        $this->addForeignKey(
            'fk-tchat_message-room_id',
            'tchat_message',
            'room_id',
            'tchat_room',
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
            'fk-tchat_message-user_id',
            'tchat_message'
        );

        $this->dropIndex(
            'idx-tchat_message-user_id',
            'tchat_message'
        );

        $this->dropForeignKey(
            'fk-tchat_message-room_id',
            'tchat_message'
        );

        $this->dropIndex(
            'idx-tchat_message-room_id',
            'tchat_message'
        );

        $this->dropTable('{{%tchat_message}}');
    }
}
