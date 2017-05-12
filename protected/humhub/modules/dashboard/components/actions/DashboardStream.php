<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/licences
 */

namespace humhub\modules\dashboard\components\actions;

use Yii;

/**
 * DashboardStreamAction
 * Note: This stream action is also used for activity e-mail content.
 *
 * @since 0.11
 * @author luke
 */
// class DashboardStream extends \humhub\modules\content\components\actions\Stream - default STREAM
class DashboardStream extends \humhub\modules\content\components\actions\TeachconnectSteam // teachconnect STREAM
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->user == null) {

            /**
             * For guests collect all wall_ids of "guest" public spaces / user profiles.
             * Generally show only public content
             */
            $publicSpacesSql = (new \yii\db\Query())
                    ->select(["si.wall_id"])
                    ->from('space si')
                    ->where('si.visibility=' . \humhub\modules\space\models\Space::VISIBILITY_ALL);
            $union = Yii::$app->db->getQueryBuilder()->build($publicSpacesSql)[0];


            $publicProfilesSql = (new \yii\db\Query())
                    ->select("pi.wall_id")
                    ->from('user pi')
                    ->where('pi.status=1 AND  pi.visibility = ' . \humhub\modules\user\models\User::VISIBILITY_ALL);
            $union .= " UNION " . Yii::$app->db->getQueryBuilder()->build($publicProfilesSql)[0];

            $this->activeQuery->andWhere('wall_entry.wall_id IN (' . $union . ')');
            $this->activeQuery->andWhere(['content.visibility' => \humhub\modules\content\models\Content::VISIBILITY_PUBLIC]);
        } else {

            /**
             * Begin visibility checks regarding the content container
             */
            $this->activeQuery->leftJoin('wall', 'wall_entry.wall_id=wall.id');
            $this->activeQuery->leftJoin(
                    'space_membership', 'wall.object_id=space_membership.space_id AND space_membership.user_id=:userId AND space_membership.status=:status', ['userId' => $this->user->id, ':status' => \humhub\modules\space\models\Membership::STATUS_MEMBER]
            );

            // In case of an space entry, we need to join the space membership to verify the user can see private space content
            $condition = ' (wall.object_model=:userModel AND content.visibility=0 AND content.user_id = :userId) OR ';
            $condition .= ' (wall.object_model=:spaceModel AND content.visibility = 0 AND space_membership.status = ' . \humhub\modules\space\models\Membership::STATUS_MEMBER . ') OR ';
            $condition .= ' (content.visibility = 1 OR content.visibility IS NULL) ';
            $this->activeQuery->andWhere($condition, [':userId' => $this->user->id, ':spaceModel' => \humhub\modules\space\models\Space::className(), ':userModel' => \humhub\modules\user\models\User::className()]);
        }
    }

}
