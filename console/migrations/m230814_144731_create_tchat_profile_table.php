<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tchat_profile}}`.
 */
class m230814_144731_create_tchat_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tchat_profile}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'firstname' => $this->string(63),
            'lastname' => $this->string(63),
            'gender' => $this->boolean(),
        ]);

        $this->createIndex(
            'idx-tchat_profile-user_id',
            'tchat_profile',
            'user_id'
        );

        $this->addForeignKey(
            'fk-tchat_profile-user_id',
            'tchat_profile',
            'user_id',
            'tchat_user',
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
            'fk-tchat_profile-user_id',
            'tchat_profile'
        );

        $this->dropIndex(
            'idx-tchat_profile-user_id',
            'tchat_profile'
        );

        $this->dropTable('{{%tchat_profile}}');
    }
}
