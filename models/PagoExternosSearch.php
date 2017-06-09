<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PagoExternos;

/**
 * PagoExternosSearch represents the model behind the search form of `app\models\PagoExternos`.
 */
class PagoExternosSearch extends PagoExternos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PEXT_ID', 'OS_ID', 'PEXT_FACTURA', 'PEXT_VALOR'], 'integer'],
            [['PEXT_FECHA'], 'safe'],
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
        $query = PagoExternos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'PEXT_ID' => $this->PEXT_ID,
            'OS_ID' => $this->OS_ID,
            'PEXT_FACTURA' => $this->PEXT_FACTURA,
            'PEXT_VALOR' => $this->PEXT_VALOR,
            'PEXT_FECHA' => $this->PEXT_FECHA,
        ]);

        return $dataProvider;
    }
}
