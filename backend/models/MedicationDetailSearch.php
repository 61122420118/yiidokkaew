<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MedicationDetail;

/**
 * MedicationDetailSearch represents the model behind the search form of `backend\models\MedicationDetail`.
 */
class MedicationDetailSearch extends MedicationDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'med_id', 'med_route', 'med_duration', 'med_status'], 'integer'],
            [['date', 'med_name', 'med_dose', 'med_frequency', 'med_purpose', 'med_time'], 'safe'],
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
        $query = MedicationDetail::find();

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
            'med_id' => $this->med_id,
            'date' => $this->date,
            'med_route' => $this->med_route,
            'med_duration' => $this->med_duration,
            'med_status' => $this->med_status,
        ]);

        $query->andFilterWhere(['like', 'med_name', $this->med_name])
            ->andFilterWhere(['like', 'med_dose', $this->med_dose])
            ->andFilterWhere(['like', 'med_frequency', $this->med_frequency])
            ->andFilterWhere(['like', 'med_purpose', $this->med_purpose])
            ->andFilterWhere(['like', 'med_time', $this->med_time]);

        return $dataProvider;
    }
}
