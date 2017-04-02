<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_profile_details`.
 */
class m170328_145322_create_user_profile_details_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_profile_details', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(16)->notNull(),
            'user_registration_details_id' => $this->integer(16)->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer(11)->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer(11)->notNull(),
        ]);

        // add foreign key
        $this->addForeignKey(
            'UPD',
            'user_profile_details',
            'user_registration_details_id',
            'user_registration_details',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_profile_details');
    }
}
