<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magwelt_class}}`.
 */
class m240525_112444_create_magwelt_class_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('magwelt_class', [
            'id' => $this->primaryKey(),
            'title' => $this->string(31)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('magwelt_class');
    }
}
