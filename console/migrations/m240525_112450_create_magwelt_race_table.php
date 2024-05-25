<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magwelt_race}}`.
 */
class m240525_112450_create_magwelt_race_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('magwelt_race', [
            'id' => $this->primaryKey(),
            'title' => $this->string(31)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('magwelt_race');
    }
}
