<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OtrosServicios;

/**
 * OtrosServiciosSearch represents the model behind the search form of `app\models\OtrosServicios`.
 */
class ImprimirOtrosServiciosSearch extends OtrosServicios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OS_ID', 'OT_ID', 'PEXT_ID', 'OS_PRECIO'], 'integer'],
            [['OS_DESCRIPCION'], 'safe'],
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
        $query = OtrosServicios::find();

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
            'OS_ID' => $this->OS_ID,
            'OT_ID' => $this->OT_ID,
            'PEXT_ID' => $this->PEXT_ID,
            'OS_PRECIO' => $this->OS_PRECIO,
        ]);

        $query->andFilterWhere(['like', 'OS_DESCRIPCION', $this->OS_DESCRIPCION]);

        return $dataProvider;
    }
}
