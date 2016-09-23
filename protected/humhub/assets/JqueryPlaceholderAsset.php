<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/licences
 */

namespace humhub\assets;

use yii\web\AssetBundle;

/**
 * jquery-placeholder
 * 
 * @author luke
 */
class JqueryPlaceholderAsset extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/jquery-placeholder';

    /**
     * @inheritdoc
     */
    public $js = ['jquery.placeholder.min.js'];

}
