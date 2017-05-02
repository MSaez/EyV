<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cobros;

/**
 * CobrosSearch represents the model behind the search form of `app\models\Cobros`.
 */
class CobrosSearch extends Cobros
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CBR_ID', 'OT_ID', 'CBR_VALOR'], 'integer'],
            [['CBR_FECHA'], 'safe'],
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
        $query = Cobros::find();

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
            'CBR_ID' => $this->CBR_ID,
            'OT_ID' => $this->OT_ID,
            'CBR_VALOR' => $this->CBR_VALOR,
            'CBR_FECHA' => $this->CBR_FECHA,
        ]);

        return $dataProvider;
    }
}
