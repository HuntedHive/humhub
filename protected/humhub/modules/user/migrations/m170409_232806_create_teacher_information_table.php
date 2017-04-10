<?php

use yii\db\Migration;

/**
 * Handles the creation of table `teacher_information`.
 */
class m170409_232806_create_teacher_information_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
            $this->createTable('teacher_information', array(
                'id' => 'int(11) NOT NULL AUTO_INCREMENT',
                'user_id' => 'int(11) NOT NULL',
                'level' => 'text COLLATE utf8_unicode_ci',
                'type' => 'text COLLATE utf8_unicode_ci',
                'subject_areas' => 'text COLLATE utf8_unicode_ci',
                'interests' => 'text COLLATE utf8_unicode_ci',
                'created_by' => 'int(11) DEFAULT NULL',
                'created_at' => 'datetime DEFAULT NULL',
                'updated_by' => 'int(11) DEFAULT NULL',
                'updated_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'PRIMARY KEY (`id`)',
                'UNIQUE KEY `user_id` (`user_id`)',
                ));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('teacher_information');
    }
}
