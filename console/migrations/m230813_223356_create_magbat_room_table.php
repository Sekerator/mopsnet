<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magbat_room}}`.
 */
class m230813_223356_create_magbat_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%magbat_room}}', [
            'id' => $this->primaryKey(),
            'status' => $this->tinyInteger(1)->defaultValue(0)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%magbat_room}}');
    }
}
