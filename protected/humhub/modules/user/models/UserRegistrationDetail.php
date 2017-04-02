<?php
/**
 * Created by PhpStorm.
 * User: kasia
 * Date: 3/29/17
 * Time: 9:25 PM
 */

namespace humhub\modules\user\models;

use humhub\components\ActiveRecord;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property bool $is_other
 */

class UserRegistrationDetail extends ActiveRecord
{
    const TYPE_TEACHER_LEVEL = 0;
    const TYPE_TEACHER_TYPE = 1;
    const TYPE_TEACHER_SUBJECT_AREA = 2;
    const TYPE_TEACHER_INTEREST = 3;

    public static function tableName() {
        return 'user_registration_details';
    }

    public function rules() {
        return [
            [['name'], 'string', 'max' => 255],
            [['type'], 'integer', 'range' => [
                self::TYPE_TEACHER_LEVEL, self::TYPE_TEACHER_TYPE,
                self::TYPE_TEACHER_SUBJECT_AREA, self::TYPE_TEACHER_INTEREST]],
            [['name', 'type', 'is_other'], 'unique'],
            ['is_other', 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Value',
            'type' => 'Entity'
        ];
    }

}
