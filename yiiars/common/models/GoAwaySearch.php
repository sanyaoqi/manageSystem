<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GoAway;

/**
 * GoAwaySearch represents the model behind the search form of `common\models\GoAway`.
 */
class GoAwaySearch extends GoAway
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'uid', 'type', 'date', 'created_at', 'did', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = GoAway::find();

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
            'gid' => $this->gid,
            'uid' => $this->uid,
            'type' => $this->type,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'did' => $this->did,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
