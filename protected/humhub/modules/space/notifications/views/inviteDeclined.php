<?php

use yii\helpers\Html;

if (!empty($originator) && is_object($originator) && !empty($originator->displayName)) {
    $displayName = Html::encode($originator->displayName);
} else {
    $displayName = '(N/A)';
}

echo Yii::t('SpaceModule.views_notifications_inviteDeclined', '{userName} declined your invite for the space {spaceName}', array(
    '{userName}' => '<strong>' . $displayName . '</strong>',
    '{spaceName}' => '<strong>' . Html::encode($source->name) . '</strong>'
));
