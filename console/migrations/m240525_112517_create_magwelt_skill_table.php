<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magwelt_skill}}`.
 */
class m240525_112517_create_magwelt_skill_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('magwelt_skill', [
            'id' => $this->primaryKey(),
            'title' => $this->string(63)->notNull(),
            'description' => $this->text()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('magwelt_skill');
    }
}
