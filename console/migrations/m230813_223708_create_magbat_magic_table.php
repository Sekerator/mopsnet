<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magbat_magic}}`.
 */
class m230813_223708_create_magbat_magic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%magbat_magic}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'mp' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-magbat_magic-user_id',
            'magbat_magic',
            'user_id'
        );

        $this->addForeignKey(
            'fk-magbat_magic-user_id',
            'magbat_magic',
            'user_id',
            'magbat_user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-magbat_magic-type_id',
            'magbat_magic',
            'type_id'
        );

        $this->addForeignKey(
            'fk-magbat_magic-type_id',
            'magbat_magic',
            'type_id',
            'magbat_magic_type',
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
            'fk-magbat_magic-user_id',
            'magbat_magic'
        );

        $this->dropIndex(
            'idx-magbat_magic-user_id',
            'magbat_magic'
        );

        $this->dropForeignKey(
            'fk-magbat_magic-type_id',
            'magbat_magic'
        );

        $this->dropIndex(
            'idx-magbat_magic-type_id',
            'magbat_magic'
        );

        $this->dropTable('{{%magbat_magic}}');
    }
}
