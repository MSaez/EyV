<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cliente;

/**
 * ClienteSearch represents the model behind the search form about `app\models\Cliente`.
 */
class ClienteSearch extends Cliente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CLI_ID'], 'integer'],
            [['CLI_NOMBRES', 'CLI_PATERNO', 'CLI_MATERNO', 'CLI_RUT', 'CLI_TELEFONO', 'CLI_DIRECCION'], 'safe'],
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
        $query = Cliente::find();

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
            'CLI_ID' => $this->CLI_ID,
        ]);

        $query->andFilterWhere(['like', 'CLI_NOMBRES', $this->CLI_NOMBRES])
            ->andFilterWhere(['like', 'CLI_PATERNO', $this->CLI_PATERNO])
            ->andFilterWhere(['like', 'CLI_MATERNO', $this->CLI_MATERNO])
            ->andFilterWhere(['like', 'CLI_RUT', $this->CLI_RUT])
            ->andFilterWhere(['like', 'CLI_TELEFONO', $this->CLI_TELEFONO])
            ->andFilterWhere(['like', 'CLI_DIRECCION', $this->CLI_DIRECCION]);

        return $dataProvider;
    }
}
