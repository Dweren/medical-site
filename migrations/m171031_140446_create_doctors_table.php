<?php

use yii\db\Migration;

/**
 * Handles the creation of table `doctors`.
 */
class m171031_140446_create_doctors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('doctors', [
            'id' => $this->primaryKey(),
            'fio' => $this->text(),
            'position' => $this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('doctors');
    }
}
