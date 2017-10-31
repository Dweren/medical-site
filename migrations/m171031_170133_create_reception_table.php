<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reception`.
 */
class m171031_170133_create_reception_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('reception', [
            'id' => $this->primaryKey(),
            'doctor_id' => $this->integer(),
            'user_id' => $this->integer(),
            'started_at' => $this->dateTime()
        ]);

        $this->createIndex(
            'idx-reception-doctor_id_user_id',
            'reception',
            ['started_at', 'doctor_id'],
            true
        );

        $this->createIndex(
            'idx-reception-doctor_id',
            'reception',
            'doctor_id'
        );

        $this->createIndex(
            'idx-reception-user_id',
            'reception',
            'user_id'
        );

        $this->addForeignKey(
            'fk-reception-doctor_id',
            'reception',
            'doctor_id',
            'doctors',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-reception-user_id',
            'reception',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-reception-user_id',
            'reception'
        );
        $this->dropForeignKey(
            'fk-reception-doctor_id',
            'reception'
        );
        $this->dropIndex(
            'idx-reception-doctor_id',
            'reception'
        );
        $this->dropIndex(
            'idx-reception-user_id',
            'reception'
        );
        $this->dropIndex(
            'idx-reception-doctor_id_user_id',
            'reception'
        );
        $this->dropTable('reception');
    }
}
