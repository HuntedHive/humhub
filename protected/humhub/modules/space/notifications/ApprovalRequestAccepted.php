<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/licences
 */

namespace humhub\modules\space\notifications;

use humhub\modules\notification\components\BaseNotification;

/**
 * SpaceApprovalRequestAcceptedNotification
 *
 * @since 0.5
 */
class ApprovalRequestAccepted extends BaseNotification
{

    /**
     * @inheritdoc
     */
    public $moduleId = "space";

    /**
     * @inheritdoc
     */
    public $viewName = "approvalRequestAccepted";

}

?>