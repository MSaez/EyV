<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inventario;

/**
 * InventarioSeach represents the model behind the search form of `app\models\Inventario`.
 */
class InventarioSeach extends Inventario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INV_ID', 'OT_ID', 'INS_ID', 'INV_CANTIDAD', 'INV_PRECIO_UNITARIO', 'INV_TOTAL'], 'integer'],
            [['INV_NOMBRE'], 'safe'],
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
        $query = Inventario::find();

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
            'INV_ID' => $this->INV_ID,
            'OT_ID' => $this->OT_ID,
            'INS_ID' => $this->INS_ID,
            'INV_CANTIDAD' => $this->INV_CANTIDAD,
            'INV_UNITARIO' => $this->INV_PRECIO_UNITARIO,
            'INV_TOTAL' => $this->INV_TOTAL,
        ]);

        $query->andFilterWhere(['like', 'INV_NOMBRE', $this->INV_NOMBRE]);

        return $dataProvider;
    }
}
