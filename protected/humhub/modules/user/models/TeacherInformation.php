<?php

namespace humhub\modules\user\models;

use humhub\components\ActiveRecord;
use humhub\modules\registration\models\ManageRegistration;

/**
 * This is the model class for table "teacher_information".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $level
 * @property string $type
 * @property string $subject_areas
 * @property string $interests
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */

class TeacherInformation extends ActiveRecord
{
    public static function tableName()
    {
        return 'teacher_information';
    }

    public function getSubjectAreasArray()
    {
        $r = json_decode($this->subject_areas, true);
        if (!is_array($r)) {
            $r = [];
        }
        return $r;
    }

    public function getLevelOther()
    {
        $m = $this->getPredefinedLevels();
        if (!in_array($this->level, $m)) {
            return $this->level;
        }
        return '';
    }

    public function getLevelValue()
    {
        $m = $this->getPredefinedLevels();
        if (in_array($this->level, $m)) {
            return $this->level;
        }
        return '__other__';
    }

    public function getTypeOther()
    {
        $m = $this->getPredefinedTypes();
        if (!in_array($this->type, $m)) {
            return $this->type;
        }
        return '';
    }

    public function getTypeValue()
    {
        $m = $this->getPredefinedTypes();
        if (in_array($this->type, $m)) {
            return $this->type;
        }
        return '__other__';
    }

    public function getSubjectAreasValue()
    {
        $unpacked = json_decode($this->subject_areas);
        if (!is_array($unpacked)) {
            $unpacked = [];
        }
        $predefs = $this->getPredefinedSubjectAreas();
        $result = [];
        foreach ($unpacked as $record) {
            if (in_array($record, $predefs)) {
                $result[] = $record;
            } else {
                $result[] = '__other__';
            }
        }
        return $result;
    }

    public function getInterestsValue()
    {
        $unpacked = json_decode($this->interests);
        if (!is_array($unpacked)) {
            $unpacked = [];
        }
        $predefs = $this->getPredefinedInterests();
        $result = [];
        foreach ($unpacked as $record) {
            if (in_array($record, $predefs)) {
                $result[] = $record;
            } else {
                $result[] = '__other__';
            }
        }
        return $result;
    }

    public function getSubjectAreasOther()
    {
        $unpacked = json_decode($this->subject_areas);
        if (!is_array($unpacked)) {
            $unpacked = [];
        }
        $predefs = $this->getPredefinedSubjectAreas();
        $result = [];
        foreach ($unpacked as $record) {
            if (!in_array($record, $predefs)) {
                $result[] = $record;
            }
        }
        return implode(", ", $result);
    }

    public function setSubjectAreasArray(array $value, $other = '')
    {
        $resulting = [];
        foreach($value as $v) {
            if ($v == '__other__' && $other != '') {
                $resulting[] = $other;
            } else {
                $resulting[] = $v;
            }
        }
        $this->subject_areas = json_encode($resulting);
    }

    public function getInterestsOther()
    {
        $unpacked = json_decode($this->interests);
        if (!is_array($unpacked)) {
            $unpacked = [];
        }
        $predefs = $this->getPredefinedInterests();
        $result = [];
        foreach ($unpacked as $record) {
            if (!in_array($record, $predefs)) {
                $result[] = $record;
            }
        }
        return implode(", ", $result);
    }

    public function getInterestsArray()
    {
        $r = json_decode($this->interests, true);
        if (!is_array($r)) {
            $r = [];
        }
        return $r;
    }

    public function setInterestsArray(array $value, $other = '')
    {
        $resulting = [];
        foreach($value as $v) {
            if ($v == '__other__' && $other != '') {
                $resulting[] = $other;
            } else {
                $resulting[] = $v;
            }
        }
        $this->interests = json_encode($resulting);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    private function getPredefinedDetails($type)
    {
        $records = ManageRegistration::findAll([
            'type' => $type
        ]);
        $result = [];
        foreach($records as $r) {
            $result[] = $r->name;
        }
        return $result;
    }

    public function getPredefinedLevels()
    {
        return $this->getPredefinedDetails(ManageRegistration::TYPE_TEACHER_LEVEL);
    }

    public function getPredefinedTypes()
    {
        return $this->getPredefinedDetails(ManageRegistration::TYPE_TEACHER_TYPE);
    }

    public function getPredefinedSubjectAreas()
    {
        return $this->getPredefinedDetails(ManageRegistration::TYPE_SUBJECT_AREA);
    }

    public function getPredefinedInterests()
    {
        return $this->getPredefinedDetails(ManageRegistration::TYPE_TEACHER_INTEREST);
    }

    public function getLevelDropdown()
    {
        $result = [];
        foreach($this->getPredefinedLevels() as $r) {
            $result[$r] = $r;
        }
        $result['__other__'] = 'Other...';
        return $result;
    }

    public function getTypeDropdown()
    {
        $result = [];
        foreach($this->getPredefinedTypes() as $r) {
            $result[$r] = $r;
        }
        $result['__other__'] = 'Other...';
        return $result;
    }

    public function getSubjectAreasDropdown()
    {
        $connection = self::getDb();
        $cmd = $connection->createCommand('
        SELECT mr.name, dr.name AS dependency
        FROM manage_registration mr 
        JOIN manage_registration dr ON (dr.id = mr.depend)
        WHERE mr.type = :mr_type
        ');
        $cmd->bindValue(':mr_type', ManageRegistration::TYPE_SUBJECT_AREA);
        $rows = $cmd->queryAll();

        $result = [];

        $ttypes = $this->getPredefinedTypes();
        foreach($ttypes as $type) {
            $result[$type] = [];
        }

        foreach($rows as $row) {
            $result[$row['dependency']][$row['name']] = $row['name'];
        }

        foreach($ttypes as $type) {
            $result[$type]['__other__'] = 'Other...';
        }

        return $result;
    }

    public function getInterestsDropdown()
    {
        $result = [];
        foreach($this->getPredefinedInterests() as $r) {
            $result[$r] = $r;
        }
        $result['__other__'] = 'Other...';
        return $result;
    }
}
