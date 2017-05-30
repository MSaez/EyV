<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ActividadDesabolladura;

/**
 * ActividadDesabolladuraSearch represents the model behind the search form about `app\models\ActividadDesabolladura`.
 */
class ImprimirActividadDesabolladuraSearch extends ActividadDesabolladura
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DES_ID', 'OT_ID', 'DES_HORAS', 'DES_PRECIO'], 'integer'],
            [['DES_DESCRIPCION', 'DES_ESTADO'], 'safe'],
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
        $query = ActividadDesabolladura::find();

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
            'DES_ID' => $this->DES_ID,
            'OT_ID' => $this->OT_ID,
            'DES_HORAS' => $this->DES_HORAS,
            'DES_PRECIO' => $this->DES_PRECIO,
        ]);

        $query->andFilterWhere(['like', 'DES_DESCRIPCION', $this->DES_DESCRIPCION])
            ->andFilterWhere(['like', 'DES_ESTADO', $this->DES_ESTADO]);

        return $dataProvider;
    }
}


