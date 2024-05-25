<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magwelt_profile}}`.
 */
class m240525_112530_create_magwelt_profile_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('magwelt_profile', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'class_id' => $this->integer()->notNull(),
            'race_id' => $this->integer()->notNull(),
            'characteristic_id' => $this->integer()->notNull(),
            'history' => $this->text(),
        ]);

        $this->createIndex(
            'idx-magwelt_profile-user_id',
            'magwelt_profile',
            'user_id'
        );

        $this->addForeignKey(
            'fk-magwelt_profile-user_id',
            'magwelt_profile',
            'user_id',
            'magwelt_user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-magwelt_profile-class_id',
            'magwelt_profile',
            'class_id'
        );

        $this->addForeignKey(
            'fk-magwelt_profile-class_id',
            'magwelt_profile',
            'class_id',
            'magwelt_class',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-magwelt_profile-race_id',
            'magwelt_profile',
            'race_id'
        );

        $this->addForeignKey(
            'fk-magwelt_profile-race_id',
            'magwelt_profile',
            'race_id',
            'magwelt_race',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-magwelt_profile-characteristic_id',
            'magwelt_profile',
            'characteristic_id'
        );

        $this->addForeignKey(
            'fk-magwelt_profile-characteristic_id',
            'magwelt_profile',
            'characteristic_id',
            'magwelt_characteristic',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-magwelt_profile-user_id',
            'magwelt_profile'
        );

        $this->dropForeignKey(
            'fk-magwelt_profile-class_id',
            'magwelt_profile'
        );

        $this->dropForeignKey(
            'fk-magwelt_profile-race_id',
            'magwelt_profile'
        );

        $this->dropForeignKey(
            'fk-magwelt_profile-characteristic_id',
            'magwelt_profile'
        );

        $this->dropTable('magwelt_profile');
    }
}
