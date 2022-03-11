<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Doctor;

/**
 * DoctorSearch represents the model behind the search form of `backend\models\Doctor`.
 */
class DoctorSearch extends Doctor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sig_status'], 'integer'],
            [['sig_name'], 'safe'],
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
        $query = Doctor::find();

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
            'sig_status' => $this->sig_status,
        ]);

        $query->andFilterWhere(['like', 'sig_name', $this->sig_name]);

        return $dataProvider;
    }
}
