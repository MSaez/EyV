<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Insumo;

/**
 * InsumoSearch represents the model behind the search form about `app\models\Insumo`.
 */
class InformeInsumoSearch extends Insumo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INS_ID', 'OT_ID', 'INS_CANTIDAD', 'INS_PRECIO_UNITARIO', 'INS_TOTAL'], 'integer'],
            [['INS_NOMBRE'], 'safe'],
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
        $query = Insumo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => false,
            
        ]);
        
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'INS_ID' => $this->INS_ID,
            'OT_ID' => $this->OT_ID,
            'INS_CANTIDAD' => $this->INS_CANTIDAD,
            'INS_PRECIO_UNITARIO' => $this->INS_PRECIO_UNITARIO,
            'INS_TOTAL' => $this->INS_TOTAL,
        ]);

        $query->andFilterWhere(['like', 'INS_NOMBRE', $this->INS_NOMBRE]);

        return $dataProvider;
    }
}
