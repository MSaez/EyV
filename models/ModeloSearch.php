<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Modelo;

/**
 * ModeloSearch represents the model behind the search form about `app\models\Modelo`.
 */
class ModeloSearch extends Modelo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MOD_ID', 'MAR_ID'], 'integer'],
            [['MOD_NOMBRE', 'MOD_VARIANTE'], 'safe'],
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
        $query = Modelo::find();

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
            'MOD_ID' => $this->MOD_ID,
            'MAR_ID' => $this->MAR_ID,
        ]);

        $query->andFilterWhere(['like', 'MOD_NOMBRE', $this->MOD_NOMBRE])
            ->andFilterWhere(['like', 'MOD_VARIANTE', $this->MOD_VARIANTE]);

        return $dataProvider;
    }
}
