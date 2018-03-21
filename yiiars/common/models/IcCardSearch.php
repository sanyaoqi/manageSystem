<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\IcCard;

/**
 * IcCardSearch represents the model behind the search form of `common\models\IcCard`.
 */
class IcCardSearch extends IcCard
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'status', 'uid', 'created_at', 'end_time'], 'integer'],
            [['code'], 'safe'],
            [['money'], 'number'],
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
        $query = IcCard::find();

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
            'cid' => $this->cid,
            'status' => $this->status,
            'uid' => $this->uid,
            'money' => $this->money,
            'created_at' => $this->created_at,
            'end_time' => $this->end_time,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
