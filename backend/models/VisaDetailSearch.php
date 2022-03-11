<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VisaDetail;

/**
 * VisaDetailSearch represents the model behind the search form of `backend\models\VisaDetail`.
 */
class VisaDetailSearch extends VisaDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'visa_id', 'visa_type'], 'integer'],
            [['visa_issue', 'visa_exp'], 'safe'],
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
        $query = VisaDetail::find();

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
            'visa_id' => $this->visa_id,
            'visa_type' => $this->visa_type,
            'visa_issue' => $this->visa_issue,
            'visa_exp' => $this->visa_exp,
        ]);

        return $dataProvider;
    }
}
