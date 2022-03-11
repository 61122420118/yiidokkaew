<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Duration;

/**
 * DurationSearch represents the model behind the search form of `backend\models\Duration`.
 */
class DurationSearch extends Duration
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dura_status'], 'integer'],
            [['dura_name'], 'safe'],
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
        $query = Duration::find();

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
            'dura_status' => $this->dura_status,
        ]);

        $query->andFilterWhere(['like', 'dura_name', $this->dura_name]);

        return $dataProvider;
    }
}
