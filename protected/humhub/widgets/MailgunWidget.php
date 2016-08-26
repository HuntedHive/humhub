<?php

namespace humhub\widgets;

use boundstate\mailgun\Mailer;
use Yii;

class MailgunWidget extends Mailer
{

    public $debug = false;

    /**
     * @inheritdoc
     */
    protected function sendMessage($message)
    {
        if ($this->debug) {
            $message->getMessageBuilder()->setTestMode(true);
        }
        return parent::sendMessage($message);
    }
}

