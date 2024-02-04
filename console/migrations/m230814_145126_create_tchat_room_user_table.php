<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tchat_room_user}}`.
 */
class m230814_145126_create_tchat_room_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tchat_room_user}}', [
            'id' => $this->primaryKey(),
            'room_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-tchat_room_user-user_id',
            'tchat_room_user',
            'user_id'
        );

        $this->addForeignKey(
            'fk-tchat_room_user-user_id',
            'tchat_room_user',
            'user_id',
            'tchat_user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-tchat_room_user-room_id',
            'tchat_room_user',
            'room_id'
        );

        $this->addForeignKey(
            'fk-tchat_room_user-room_id',
            'tchat_room_user',
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
            'fk-tchat_room_user-user_id',
            'tchat_room_user'
        );

        $this->dropIndex(
            'idx-tchat_room_user-user_id',
            'tchat_room_user'
        );

        $this->dropForeignKey(
            'fk-tchat_room_user-room_id',
            'tchat_room_user'
        );

        $this->dropIndex(
            'idx-tchat_room_user-room_id',
            'tchat_room_user'
        );

        $this->dropTable('{{%tchat_room_user}}');
    }
}
