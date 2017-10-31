<?php

use yii\db\Migration;

/**
 * Handles adding birthday to table `user`.
 */
class m171031_163434_add_birthday_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'birthday', $this->date());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'birthday');
    }
}
