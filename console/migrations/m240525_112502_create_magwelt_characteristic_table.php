<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magwelt_characteristic}}`.
 */
class m240525_112502_create_magwelt_characteristic_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('magwelt_characteristic', [
            'id' => $this->primaryKey(),
            'str' => $this->integer()->defaultValue(0),
            'dex' => $this->integer()->defaultValue(0),
            'con' => $this->integer()->defaultValue(0),
            'int' => $this->integer()->defaultValue(0),
            'wis' => $this->integer()->defaultValue(0),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('magwelt_characteristic');
    }
}
