<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Relationship;

/**
 * RelationshipSearch represents the model behind the search form of `backend\models\Relationship`.
 */
class RelationshipSearch extends Relationship
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'relaship_status'], 'integer'],
            [['relaship_name'], 'safe'],
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
        $query = Relationship::find();

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
            'relaship_status' => $this->relaship_status,
        ]);

        $query->andFilterWhere(['like', 'relaship_name', $this->relaship_name]);

        return $dataProvider;
    }
}
