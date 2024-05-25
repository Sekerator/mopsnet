<?php

use yii\db\Migration;

/**
 * Class m240525_115548_add_initial_data_to_race_table
 */
class m240525_115548_add_initial_data_to_race_table extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('magwelt_race', ['title'], [
            ['Человек'],
            ['Нежить'],
            ['Эльф'],
            ['Орк'],
            ['Дворф'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('magwelt_race', ['title' => ['Человек', 'Нежить', 'Эльф', 'Орк', 'Дворф']]);
    }
}
