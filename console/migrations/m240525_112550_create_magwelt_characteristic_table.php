<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magwelt_characteristic}}`.
 */
class m240525_112550_create_magwelt_characteristic_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('magwelt_characteristic', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'str' => $this->integer()->defaultValue(0),
            'dex' => $this->integer()->defaultValue(0),
            'con' => $this->integer()->defaultValue(0),
            'int' => $this->integer()->defaultValue(0),
            'wis' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex(
            'idx-magwelt_characteristic-user_id',
            'magwelt_characteristic',
            'user_id'
        );

        $this->addForeignKey(
            'fk-magwelt_characteristic-user_id',
            'magwelt_characteristic',
            'user_id',
            'magwelt_profile',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-magwelt_characteristic-user_id',
            'magwelt_characteristic'
        );

        $this->dropTable('magwelt_characteristic');
    }
}
