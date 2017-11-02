<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ReceptionSearch represents the model behind the search form of `app\models\Reception`.
 */
class ReceptionSearch extends Reception
{

    public $position;
    public $id;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['started_at', 'doctor_id', 'user_id', 'position'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Reception::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'doctor_id' => [
                    'asc' => ['doctors.fio' => SORT_ASC],
                    'desc' => ['doctors.fio' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'user_id' => [
                    'asc' => ['user.username' => SORT_ASC],
                    'desc' => ['user.username' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'started_at' => [
                    'asc' => ['started_at' => SORT_ASC],
                    'desc' => ['started_at' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'position' => [
                    'asc' => ['doctors.position' => SORT_ASC],
                    'desc' => ['doctors.position' => SORT_DESC],
                    'default' => SORT_ASC
                ],
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['doctor']);
            return $dataProvider;
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith(['doctor', 'user']);
        $query->andFilterWhere(['like', 'lower(doctors.position)', mb_strtolower($this->position, 'UTF-8')]);
        $query->andFilterWhere(['like', 'lower(doctors.fio)', mb_strtolower($this->doctor_id, 'UTF-8')]);
        $query->andFilterWhere(['like', 'lower(user.username)', mb_strtolower($this->user_id, 'UTF-8')]);
        $query->andFilterWhere(['like', "DATE_FORMAT(started_at,'%Y-%m-%d %H:%i')", $this->started_at]);

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        return $dataProvider;
    }
}
