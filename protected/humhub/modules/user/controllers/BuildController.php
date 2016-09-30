<?php

/**
 * Connected Communities Initiative
 * Copyright (C) 2016  Queensland University of Technology
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/licences GNU AGPL v3
 *
 */

namespace humhub\modules\user\controllers;

use humhub\components\Controller;
use humhub\modules\user\models\Password;
use humhub\modules\user\models\User;
use Yii;
use humhub\modules\chat\models\WBSChatSmile;

class BuildController extends Controller
{
    private $TOKEN = 'fc6d59bf-b48f-42db-94c0-714bf8248173';

    public function beforeAction($action)
    {
        \Yii::$app->controller->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionCreateAccount()
    {
        $this->forcePostRequest();
        $post = \Yii::$app->request->post();
        if(!isset($post['token']) || $this->TOKEN != $post['token']) {
            throw new \yii\web\HttpException(400, 'Invalid data');
        }
        $curUser = User::find()->andWhere(['username' => $post['User']['username']])->one();
        if(!empty($curUser)) {
            return "Isset User";
        }

        $userModel = new User();
        $userModel->scenario = 'registration';
        $userPasswordModel = new Password();
        $userPasswordModel->scenario = 'registration';
        $profileModel = $userModel->profile;
        $profileModel->scenario = 'registration';

        // Build Form Definition
        $definition = array();
        $definition['elements'] = array();

        // Add User Form
        $definition['elements']['User'] = array(
            'type' => 'form',
            'elements' => array(
                'username' => array(
                    'type' => 'text',
                    'class' => 'form-control',
                    'maxlength' => 25,
                ),
                'email' => array(
                    'type' => 'text',
                    'class' => 'form-control',
                    'maxlength' => 100,
                )
            ),
        );

        // Add User Password Form
        $definition['elements']['Password'] = array(
            'type' => 'form',
            'elements' => array(
                'newPassword' => array(
                    'type' => 'password',
                    'class' => 'form-control',
                    'maxlength' => 255,
                ),
                'newPasswordConfirm' => array(
                    'type' => 'password',
                    'class' => 'form-control',
                    'maxlength' => 255,
                ),
            ),
        );

        // Add Profile Form
        $definition['elements']['Profile'] = array_merge(array('type' => 'form'), $profileModel->getFormDefinition());

        // Get Form Definition
        $definition['buttons'] = array(
            'save' => array(
                'type' => 'submit',
                'class' => 'btn btn-primary',
                'label' => Yii::t('InstallerModule.controllers_ConfigController', 'Create Admin Account'),
            ),
        );
        
        $form = new \humhub\compat\HForm($definition);
        $form->models['User'] = $userModel;
        $form->models['User']->group_id = 1;
        $form->models['Password'] = $userPasswordModel;
        $form->models['Profile'] = $profileModel;
        if ($form->submitted() && $form->validate()) {
            $form->models['User']->status = User::STATUS_ENABLED;
            $form->models['User']->super_admin = true;
            $form->models['User']->language = '';
            $form->models['User']->tags = 'Administration, Support, HumHub';
            $form->models['User']->last_activity_email = new \yii\db\Expression('NOW()');
            $form->models['User']->save();

            $form->models['Profile']->user_id = $form->models['User']->id;
            $form->models['Profile']->title = "System Administration";
            $form->models['Profile']->save();

            // Save User Password
            $form->models['Password']->user_id = $form->models['User']->id;
            $form->models['Password']->setPassword($form->models['Password']->newPassword);
            $form->models['Password']->save();

            $userId = $form->models['User']->id;

            // Switch Identity
            Yii::$app->user->switchIdentity($form->models['User']);
        }
    }

    public function actionUploadIcons()
    {
        $post = \Yii::$app->request->post();
        if(!isset($post['token']) || $this->TOKEN != $post['token']) {
            throw new \yii\web\HttpException(400, 'Invalid data');
        }

        $i = 0;
        $listFiles = [];
        $modulePath = Yii::getAlias('@webroot/uploads/emojione');
        $listFiles = scandir($modulePath);
        $lastObjId = 0;
        $lastObj = WBSChatSmile::find()->orderBy(['id' => SORT_DESC])->one();
        if(!empty($lastObj)) {
            $lastObjId = $lastObj->id;
        }

        unset($listFiles[0]);unset($listFiles[1]);
        foreach ($listFiles as $file) {
            preg_match("/([a-zA-Z0-9]+.(png|jpeg|jpg))/i", $file, $matches);
            $obj = WBSChatSmile::find()->andFilterWhere(['link' => $file])->one();
            if(isset($matches[0]) && empty($obj)) {
                $model = new WBSChatSmile();
                $model->link = $file;
                $model->symbol = ":" . $lastObjId . ":";
                $model->save();
                $lastObjId = $model->getPrimaryKey();
            }
        }
    }
    
    public function actionTriggedSearch()
    {
        $post = \Yii::$app->request->post();
        if(!isset($post['token']) || $this->TOKEN != $post['token']) {
            throw new \yii\web\HttpException(400, 'Invalid data');
        }

        Yii::$app->search->rebuild();

        return var_dump("Success");
    }
}
