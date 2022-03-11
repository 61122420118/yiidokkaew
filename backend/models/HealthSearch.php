<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Health;

/**
 * HealthSearch represents the model behind the search form of `backend\models\Health`.
 */
class HealthSearch extends Health
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'profile_id', 'user'], 'integer'],
            [['symptom', 'ls_doc', 'ls_where', 'sig_health', 'date_assessed', 'create_at', 'update_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params)
    {
        $query = Health::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'profile_id' => $this->profile_id,
            'ls_doc' => $this->ls_doc,
            'date_assessed' => $this->date_assessed,
            'user' => $this->user,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'symptom', $this->symptom])
            ->andFilterWhere(['like', 'ls_where', $this->ls_where])
            ->andFilterWhere(['like', 'sig_health', $this->sig_health]);

        return $dataProvider;
    }
}
