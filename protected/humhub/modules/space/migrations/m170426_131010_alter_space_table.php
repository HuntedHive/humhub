<?php

use yii\db\Migration;

class m170426_131010_alter_space_table extends Migration
{
    public function up()
    {
        $this->alterColumn('space', 'name', "varchar(60) NOT NULL");

    }

    public function down()
    {
        echo "m170426_131010_alter_space_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
