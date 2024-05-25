<?php

use yii\db\Migration;

/**
 * Class m240525_115218_add_initial_data_to_class_table
 */
class m240525_115218_add_initial_data_to_class_table extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('magwelt_class', ['title'], [
            ['Маг'],
            ['Паладин'],
            ['Берсерк'],
            ['Убийца'],
            ['Некромант'],
            ['Друид'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('magwelt_class', ['title' => ['Маг', 'Паладин', 'Берсерк', 'Убийца', 'Некромант', 'Друид']]);
    }
}
