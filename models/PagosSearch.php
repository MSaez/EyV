<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pagos;

/**
 * PagosSearch represents the model behind the search form of `app\models\Pagos`.
 */
class PagosSearch extends Pagos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PAG_ID', 'OS_ID', 'INS_ID', 'PAG_FACTURA', 'PAG_VALOR'], 'integer'],
            [['PAG_FECHA'], 'safe'],
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
        $query = Pagos::find();

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
            'PAG_ID' => $this->PAG_ID,
            'OS_ID' => $this->OS_ID,
            'INS_ID' => $this->INS_ID,
            'PAG_FACTURA' => $this->PAG_FACTURA,
            'PAG_VALOR' => $this->PAG_VALOR,
            'PAG_FECHA' => $this->PAG_FECHA,
        ]);

        return $dataProvider;
    }
}
