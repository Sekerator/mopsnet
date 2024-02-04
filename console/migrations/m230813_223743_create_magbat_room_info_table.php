<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magbat_room_info}}`.
 */
class m230813_223743_create_magbat_room_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%magbat_room_info}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'room_id' => $this->integer()->notNull(),
            'hp' => $this->integer()->defaultValue(100)->notNull(),
            'mp' => $this->integer()->defaultValue(100)->notNull()
        ]);

        $this->createIndex(
            'idx-magbat_room_info-user_id',
            'magbat_room_info',
            'user_id'
        );

        $this->addForeignKey(
            'fk-magbat_room_info-user_id',
            'magbat_room_info',
            'user_id',
            'magbat_user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-magbat_room_info-room_id',
            'magbat_room_info',
            'room_id'
        );

        $this->addForeignKey(
            'fk-magbat_room_info-room_id',
            'magbat_room_info',
            'room_id',
            'magbat_room',
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
            'fk-magbat_room_info-user_id',
            'magbat_room_info'
        );

        $this->dropIndex(
            'idx-magbat_room_info-user_id',
            'magbat_room_info'
        );

        $this->dropForeignKey(
            'fk-magbat_room_info-room_id',
            'magbat_room_info'
        );

        $this->dropIndex(
            'idx-magbat_room_info-room_id',
            'magbat_room_info'
        );

        $this->dropTable('{{%magbat_room_info}}');
    }
}
