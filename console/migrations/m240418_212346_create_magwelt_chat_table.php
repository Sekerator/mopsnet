<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magwelt_chat}}`.
 */
class m240418_212346_create_magwelt_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%magwelt_chat}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->defaultValue('Magic Welt'),
            'status' => $this->smallInteger()->defaultValue(1)
        ]);

        $this->createIndex(
            'idx-magwelt_chat-user_id',
            'magwelt_chat',
            'user_id'
        );

        $this->addForeignKey(
            'fk-magwelt_chat-user_id',
            'magwelt_chat',
            'user_id',
            'magwelt_user',
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
            'fk-magwelt_chat-user_id',
            'magwelt_chat'
        );

        $this->dropIndex(
            'idx-magwelt_chat-user_id',
            'magwelt_chat'
        );

        $this->dropTable('{{%magwelt_chat}}');
    }
}
