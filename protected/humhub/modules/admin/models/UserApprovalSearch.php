<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.org/licences
 */

namespace humhub\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use humhub\modules\user\models\User;

/**
 * Description of UserSearch
 *
 * @author luke
 */
class UserApprovalSearch extends User
{

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['profile.firstname', 'profile.lastname', 'group.name', 'group.id']);
    }

    public function rules()
    {
        return [
            [['id', 'group.id'], 'integer'],
            [['username', 'email', 'created_at', 'profile.firstname', 'profile.lastname'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params = [])
    {
        $query = User::find()->joinWith(['profile', 'group']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'group.id',
                'username',
                'email',
                'super_admin',
                'profile.firstname',
                'profile.lastname',
                'created_at',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }


        /**
         * Limit Groups
         */
        $groups = $this->getGroups();
        $groupIds = [];
        foreach ($groups as $group) {
            $groupIds[] = $group->id;
        }
        $query->andWhere(['IN', 'group_id', $groupIds]);

        $query->andWhere(['status' => User::STATUS_NEED_APPROVAL]);
        $query->andFilterWhere(['user.id' => $this->id]);
        $query->andFilterWhere(['group.id' => $this->getAttribute('group.id')]);
        $query->andFilterWhere(['super_admin' => $this->super_admin]);
        $query->andFilterWhere(['like', 'user.id', $this->id]);
        $query->andFilterWhere(['like', 'user.username', $this->username]);
        $query->andFilterWhere(['like', 'user.email', $this->email]);
        $query->andFilterWhere(['like', 'profile.firstname', $this->getAttribute('profile.firstname')]);
        $query->andFilterWhere(['like', 'profile.lastname', $this->getAttribute('profile.lastname')]);

        return $dataProvider;
    }

    /**
     * Get approval groups
     */
    public function getGroups()
    {
        if (Yii::$app->user->isAdmin()) {
            return \humhub\modules\user\models\Group::find()->all();
        } else {
            $groups = [];
            foreach (\humhub\modules\user\models\GroupAdmin::find()->joinWith('group')->where(['user_id' => Yii::$app->user->id])->all() as $groupAdmin) {
                if ($groupAdmin->group !== null)
                    $groups[] = $groupAdmin->group;
            }
            return $groups;
        }
    }

}
