<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_registration_details`.
 */
class m170328_145250_create_user_registration_details_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_registration_details', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'type' => $this->integer(16)->notNull(),
            'is_other' => $this->boolean()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer(11)->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer(11)->notNull(),
        ]);
        $this->createIndex('idx_uniq_type_name', 'user_registration_details', [
            'type', 'name', 'is_other'
        ], true);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_registration_details');
    }
}
