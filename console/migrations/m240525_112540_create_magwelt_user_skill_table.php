<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magwelt_user_skill}}`.
 */
class m240525_112540_create_magwelt_user_skill_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('magwelt_user_skill', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'skill_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-magwelt_user_skill-user_id',
            'magwelt_user_skill',
            'user_id'
        );

        $this->addForeignKey(
            'fk-magwelt_user_skill-user_id',
            'magwelt_user_skill',
            'user_id',
            'magwelt_profile',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-magwelt_user_skill-skill_id',
            'magwelt_user_skill',
            'skill_id'
        );

        $this->addForeignKey(
            'fk-magwelt_user_skill-skill_id',
            'magwelt_user_skill',
            'skill_id',
            'magwelt_skill',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-magwelt_user_skill-user_id',
            'magwelt_user_skill'
        );

        $this->dropForeignKey(
            'fk-magwelt_user_skill-skill_id',
            'magwelt_user_skill'
        );

        $this->dropTable('magwelt_user_skill');
    }
}
