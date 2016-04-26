<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ActividadPintura;

/**
 * ActividadPinturaSearch represents the model behind the search form about `app\models\ActividadPintura`.
 */
class ActividadPinturaSearch extends ActividadPintura
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PIN_ID', 'OT_ID', 'PIN_HORAS', 'PIN_PRECIO'], 'integer'],
            [['EMP_RUT', 'PIN_DESCRIPCION', 'PIN_ESTADO'], 'safe'],
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
        $query = ActividadPintura::find();

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
            'PIN_ID' => $this->PIN_ID,
            'OT_ID' => $this->OT_ID,
            'PIN_HORAS' => $this->PIN_HORAS,
            'PIN_PRECIO' => $this->PIN_PRECIO,
        ]);

        $query->andFilterWhere(['like', 'EMP_RUT', $this->EMP_RUT])
            ->andFilterWhere(['like', 'PIN_DESCRIPCION', $this->PIN_DESCRIPCION])
            ->andFilterWhere(['like', 'PIN_ESTADO', $this->PIN_ESTADO]);

        return $dataProvider;
    }
}
