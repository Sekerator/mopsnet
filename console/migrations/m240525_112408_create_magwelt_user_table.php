<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magwelt_user}}`.
 */
class m240525_112408_create_magwelt_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('magwelt_user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(31)->notNull()->unique(),
            'phone' => $this->string(31)->notNull()->unique(),
            'auth_token' => $this->string(63),
            'code' => $this->integer(),
            'login_attempt' => $this->integer()->defaultValue(0),
            'status' => $this->integer()->defaultValue(1),
            'created_at' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('magwelt_user');
    }
}
