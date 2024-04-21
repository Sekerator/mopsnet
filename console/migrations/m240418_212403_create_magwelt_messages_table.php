<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magwelt_messages}}`.
 */
class m240418_212403_create_magwelt_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%magwelt_messages}}', [
            'id' => $this->primaryKey(),
            'chat_id' => $this->integer()->notNull(),
            'sender' => $this->string(31)->notNull(),
            'message' => $this->text()->notNull(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer()
        ]);

        $this->createIndex(
            'idx-magwelt_messages-chat_id',
            'magwelt_messages',
            'chat_id'
        );

        $this->addForeignKey(
            'fk-magwelt_messages-chat_id',
            'magwelt_messages',
            'chat_id',
            'magwelt_chat',
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
            'fk-magwelt_messages-chat_id',
            'magwelt_messages'
        );

        $this->dropIndex(
            'idx-magwelt_messages-chat_id',
            'magwelt_messages'
        );

        $this->dropTable('{{%magwelt_messages}}');
    }
}
