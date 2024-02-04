<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magbat_magic_direction}}`.
 */
class m230813_223726_create_magbat_magic_direction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%magbat_magic_direction}}', [
            'id' => $this->primaryKey(),
            'magic_id' => $this->integer()->notNull(),
            'point' => $this->string(255)->notNull(),
            'order' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-magbat_magic_direction-magic_id',
            'magbat_magic_direction',
            'magic_id'
        );

        $this->addForeignKey(
            'fk-magbat_magic_direction-magic_id',
            'magbat_magic_direction',
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
            'fk-magbat_magic_direction-magic_id',
            'magbat_magic_direction'
        );

        $this->dropIndex(
            'idx-magbat_magic_direction-magic_id',
            'magbat_magic_direction'
        );

        $this->dropTable('{{%magbat_magic_direction}}');
    }
}
