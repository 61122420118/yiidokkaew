<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Admit;

/**
 * AdmitSearch represents the model behind the search form of `backend\models\Admit`.
 */
class AdmitSearch extends Admit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'profile_id', 'dc_detail'], 'integer'],
            [['admit_date', 'dc_date', 'ad_remark'], 'safe'],
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
        $query = Admit::find();

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
            'admit_date' => $this->admit_date,
            'dc_date' => $this->dc_date,
            'dc_detail' => $this->dc_detail,
        ]);

        $query->andFilterWhere(['like', 'ad_remark', $this->ad_remark]);

        return $dataProvider;
    }
}
