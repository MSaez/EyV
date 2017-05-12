<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ot;

/**
 * OtSearch represents the model behind the search form about `app\models\Ot`.
 */
class OtAtrasadosSearch extends Ot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID', 'OD_ID', 'CBR_ID', 'VEH_ID', 'CLI_ID', 'OT_SUBTOTAL', 'OT_IVA', 'OT_TOTAL', 'OT_TOTAL_HORAS'], 'integer'],
            [['OT_INICIO', 'OT_ENTREGA', 'OT_OBSERVACIONES', 'OT_ESTADO'], 'safe'],
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
        // la consulta para el informe de trabajos atrasados sería más o menos asi:
        // SELECT * FROM `ot` WHERE (`OT_ENTREGA` < NOW()) AND `OT_ESTADO` = 'OT' 
        $query = Ot::find()->where('OT_ESTADO = "OT"')->andWhere('OT_ENTREGA < NOW()');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'OT_ID' => $this->OT_ID,
            'OD_ID' => $this->OD_ID,
            'CBR_ID' => $this->CBR_ID,
            'VEH_ID' => $this->VEH_ID,
            'CLI_ID' => $this->CLI_ID,
            'OT_INICIO' => $this->OT_INICIO,
            'OT_ENTREGA' => $this->OT_ENTREGA,
            'OT_SUBTOTAL' => $this->OT_SUBTOTAL,
            'OT_IVA' => $this->OT_IVA,
            'OT_TOTAL' => $this->OT_TOTAL,
            'OT_TOTAL_HORAS' => $this->OT_TOTAL_HORAS,
            'OT_ESTADO' => $this->OT_ESTADO
        ]);

        $query->andFilterWhere(['like', 'OT_OBSERVACIONES', $this->OT_OBSERVACIONES])
                ->andFilterWhere(['like', 'Presupuesto', $this->OT_ESTADO]);

        return $dataProvider;
    }
}
