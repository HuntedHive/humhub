<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/licences
 */

namespace humhub\modules\like\activities;

use humhub\modules\activity\components\BaseActivity;

/**
 * Description of SpaceCreated
 *
 * @author luke
 */
class Liked extends BaseActivity
{

    /**
     * @inheritdoc
     */
    public $moduleId = 'like';

    /**
     * @inheritdoc
     */
    public $viewName = 'liked';

    /**
     * @inheritdoc
     */
    public function render($mode = self::OUTPUT_WEB, $params = array())
    {
        $like = $this->source;
        $likeSource = $like->getSource();
        $params['preview'] = $this->getContentInfo($likeSource);

        return parent::render($mode, $params);
    }

}
