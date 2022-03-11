<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Medication;

/**
 * MedicationSearch represents the model behind the search form of `backend\models\Medication`.
 */
class MedicationSearch extends Medication
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'profile_id'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
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
        $query = Medication::find();

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
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        return $dataProvider;
    }
}
