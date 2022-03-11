<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Physical;

/**
 * PhysicalSearch represents the model behind the search form of `backend\models\Physical`.
 */
class PhysicalSearch extends Physical
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'profile_id', 'pulse', 'respira', 'user'], 'integer'],
            [['height', 'weight', 'temp'], 'number'],
            [['vision', 'hearing', 'teeth', 'cardiac', 'respiratory', 'gi', 'gini_touri', 'neurological', 'neurovascular', 'integument', 'assis_devices', 'summary', 'doctor', 'exam_date', 'create_at', 'update_at'], 'safe'],
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
        $query = Physical::find();

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
            'height' => $this->height,
            'weight' => $this->weight,
            'temp' => $this->temp,
            'pulse' => $this->pulse,
            'respira' => $this->respira,
            'exam_date' => $this->exam_date,
            'user' => $this->user,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'vision', $this->vision])
            ->andFilterWhere(['like', 'hearing', $this->hearing])
            ->andFilterWhere(['like', 'teeth', $this->teeth])
            ->andFilterWhere(['like', 'cardiac', $this->cardiac])
            ->andFilterWhere(['like', 'respiratory', $this->respiratory])
            ->andFilterWhere(['like', 'gi', $this->gi])
            ->andFilterWhere(['like', 'gini_touri', $this->gini_touri])
            ->andFilterWhere(['like', 'neurological', $this->neurological])
            ->andFilterWhere(['like', 'neurovascular', $this->neurovascular])
            ->andFilterWhere(['like', 'integument', $this->integument])
            ->andFilterWhere(['like', 'assis_devices', $this->assis_devices])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'doctor', $this->doctor]);

        return $dataProvider;
    }
}
