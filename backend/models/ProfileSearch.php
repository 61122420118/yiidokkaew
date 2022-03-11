<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `backend\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nationality', 'age', 'village_no', 'post', 'user'], 'integer'],
            [['dk_code', 'lastname', 'firstname', 'middlename', 'birth_date', 'house_no', 'alley', 'road', 'sub_district', 'district', 'province', 'country', 'phone', 'email', 'idcard', 'issued_at', 'date_issue', 'passport_exp', 'create_at', 'update_at'], 'safe'],
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
    public $from_date;
    public $to_date;
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Profile::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        

        $this->load($params);


        $ageYear = '';
        if (!empty($this->birth_date)) {
            $stripInt = (int) $this->birth_date;
            $ageYear = date('Y', strtotime("-$stripInt years"));//Search by year with respect to user entered date!
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'YEAR(birth_date)' => $ageYear,
        ]);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'birth_date' => $this->birth_date,
            'nationality' => $this->nationality,
            'sex' => $this->sex,
            'village_no' => $this->village_no,
            'post' => $this->post,
            'date_issue' => $this->date_issue,
            'passport_exp' => $this->passport_exp,
            'user' => $this->user,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'dk_code', $this->dk_code])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'middlename', $this->middlename])
            ->andFilterWhere(['like', 'house_no', $this->house_no])
            ->andFilterWhere(['like', 'alley', $this->alley])
            ->andFilterWhere(['like', 'road', $this->road])
            ->andFilterWhere(['like', 'sub_district', $this->sub_district])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'idcard', $this->idcard])
            ->andFilterWhere(['like', 'issued_at', $this->issued_at]);

        return $dataProvider;
    }
}
