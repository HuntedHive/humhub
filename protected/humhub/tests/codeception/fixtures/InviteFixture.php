<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/licences
 */

namespace tests\codeception\fixtures;

use yii\test\ActiveFixture;

class InviteFixture extends ActiveFixture
{

    public $modelClass = 'humhub\modules\user\models\Invite';

    public $dataFile = '@tests/codeception/fixtures/data/user_invite.php';

}
