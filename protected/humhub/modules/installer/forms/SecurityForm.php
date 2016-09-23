<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/licences
 */

namespace humhub\modules\installer\forms;

use Yii;

/**
 * Security Settings Form
 *
 * @since 0.5
 */
class SecurityForm extends \yii\base\Model
{

    /**
     * @var boolean allow guest acccess
     */
    public $allowGuestAccess;

    /**
     * @var boolean need approval
     */
    public $internalRequireApprovalAfterRegistration;

    /**
     * @var boolean allow anonymous registration
     */
    public $internalAllowAnonymousRegistration;

    /**
     * @var boolean allow invite from external users by email
     */
    public $canInviteExternalUsersByEmail;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array(
            array(['allowGuestAccess', 'internalRequireApprovalAfterRegistration', 'internalAllowAnonymousRegistration'], 'boolean'),
        );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array(
            'allowGuestAccess' => Yii::t('InstallerModule.forms_SecurityForm', 'Allow access for non-registered users to public content (guest access)'),
            'internalRequireApprovalAfterRegistration' => Yii::t('InstallerModule.forms_SecurityForm', 'Newly registered users have to be activated by an admin first'),
            'internalAllowAnonymousRegistration' => Yii::t('InstallerModule.forms_SecurityForm', 'External user can register (The registration form will be displayed at Login))'),
            'canInviteExternalUsersByEmail' => Yii::t('InstallerModule.forms_SecurityForm', 'Registered members can invite new users via email'),
        );
    }

}
