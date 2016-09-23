<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/licences
 */

namespace humhub\modules\search\libs;

/**
 * Description of SearchResult
 *
 * @author luke
 */
class SearchResultSet
{

    public $results = array();
    public $total;
    public $page;
    public $pageSize;

    public function getResultInstances()
    {
        $instances = array();

        foreach ($this->results as $result) {
            $modelClass = $result->model;
            if(class_exists($modelClass)) {
                $instance = $modelClass::findOne(['id' => $result->pk]);
                if ($instance !== null) {
                    $instances[] = $instance;
                } else {
                    \Yii::error('Could not load search result ' . $result->model . " - " . $result->pk);
                }
            }
        }

        return $instances;
    }

}
