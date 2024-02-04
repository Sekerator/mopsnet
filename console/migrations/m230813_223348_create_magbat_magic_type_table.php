<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magbat_magic_type}}`.
 */
class m230813_223348_create_magbat_magic_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%magbat_magic_type}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%magbat_magic_type}}');
    }
}
