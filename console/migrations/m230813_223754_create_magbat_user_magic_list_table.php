<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magbat_user_magic_list}}`.
 */
class m230813_223754_create_magbat_user_magic_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%magbat_user_magic_list}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'magic_id' => $this->integer()->notNull(),
            'status' => $this->boolean()->defaultValue(0)->notNull()
        ]);

        $this->createIndex(
            'idx-magbat_user_magic_list-user_id',
            'magbat_user_magic_list',
            'user_id'
        );

        $this->addForeignKey(
            'fk-magbat_user_magic_list-user_id',
            'magbat_user_magic_list',
            'user_id',
            'magbat_user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-magbat_user_magic_list-magic_id',
            'magbat_user_magic_list',
            'magic_id'
        );

        $this->addForeignKey(
            'fk-magbat_user_magic_list-magic_id',
            'magbat_user_magic_list',
            'magic_id',
            'magbat_magic',
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
            'fk-magbat_user_magic_list-user_id',
            'magbat_user_magic_list'
        );

        $this->dropIndex(
            'idx-magbat_user_magic_list-user_id',
            'magbat_user_magic_list'
        );

        $this->dropForeignKey(
            'fk-magbat_user_magic_list-magic_id',
            'magbat_user_magic_list'
        );

        $this->dropIndex(
            'idx-magbat_user_magic_list-magic_id',
            'magbat_user_magic_list'
        );

        $this->dropTable('{{%magbat_user_magic_list}}');
    }
}
