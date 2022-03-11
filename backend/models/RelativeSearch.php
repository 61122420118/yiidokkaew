<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Relative;

/**
 * RelativeSearch represents the model behind the search form of `backend\models\Relative`.
 */
class RelativeSearch extends Relative
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'profile_id', 'relaship_id', 'rela_village_no', 'rela_post', 'rela_status'], 'integer'],
            [['rela_name', 'rela_house_no', 'rela_alley', 'rela_road', 'rela_sub_district', 'rela_district', 'rela_province',
             'rela_country', 'rela_phone', 'rela_email', 'create_at', 'update_at'], 'safe'],
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
        $query = Relative::find();

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
            'relaship_id' => $this->relaship_id,
            'rela_village_no' => $this->rela_village_no,
            'rela_post' => $this->rela_post,
            'rela_status' => $this->rela_status,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'rela_name', $this->rela_name])
            ->andFilterWhere(['like', 'rela_house_no', $this->rela_house_no])
            ->andFilterWhere(['like', 'rela_alley', $this->rela_alley])
            ->andFilterWhere(['like', 'rela_road', $this->rela_road])
            ->andFilterWhere(['like', 'rela_sub_district', $this->rela_sub_district])
            ->andFilterWhere(['like', 'rela_district', $this->rela_district])
            ->andFilterWhere(['like', 'rela_province', $this->rela_province])
            ->andFilterWhere(['like', 'rela_country', $this->rela_country])
            ->andFilterWhere(['like', 'rela_phone', $this->rela_phone])
            ->andFilterWhere(['like', 'rela_email', $this->rela_email]);

        return $dataProvider;
    }
}
