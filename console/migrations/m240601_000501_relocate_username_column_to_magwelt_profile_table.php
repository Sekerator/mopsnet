<?php

use yii\db\Migration;

class m240601_000501_relocate_username_column_to_magwelt_profile_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('magwelt_profile', 'username', $this->string(31)->notNull()->unique());
        $this->dropColumn('magwelt_user', 'username');
    }

    public function safeDown()
    {
        $this->dropColumn('magwelt_profile', 'username');
        $this->addColumn('magwelt_user', 'username', $this->string(31)->notNull()->unique());
    }
}
