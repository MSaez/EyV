<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PagoInsumos;

/**
 * PagoInsumosSearch represents the model behind the search form of `app\models\PagoInsumos`.
 */
class PagoInsumosSearch extends PagoInsumos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PINS_ID', 'INS_ID', 'PINS_FACTURA', 'PINS_VALOR'], 'integer'],
            [['PINS_FECHA'], 'safe'],
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
        $query = PagoInsumos::find();
        


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
            'PINS_ID' => $this->PINS_ID,
            'INS_ID' => $this->INS_ID,
            'PINS_FACTURA' => $this->PINS_FACTURA,
            'PINS_VALOR' => $this->PINS_VALOR,
            'PINS_FECHA' => $this->PINS_FECHA,
        ]);

        return $dataProvider;
    }
}
