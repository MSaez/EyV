<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vehiculo;

/**
 * VehiculoSearch represents the model behind the search form about `app\models\Vehiculo`.
 */
class VehiculoSearch extends Vehiculo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['VEH_ID', 'MAR_ID', 'MOD_ID', 'CLI_ID', 'VEH_ANIO'], 'integer'],
            [['VEH_CHASIS', 'VEH_MOTOR', 'VEH_COLOR', 'VEH_PATENTE'], 'safe'],
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
        $query = Vehiculo::find();

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
            'VEH_ID' => $this->VEH_ID,
            'MAR_ID' => $this->MAR_ID,
            'MOD_ID' => $this->MOD_ID,
            'CLI_ID' => $this->CLI_ID,
            'VEH_ANIO' => $this->VEH_ANIO,
        ]);

        $query->andFilterWhere(['like', 'VEH_CHASIS', $this->VEH_CHASIS])
            ->andFilterWhere(['like', 'VEH_MOTOR', $this->VEH_MOTOR])
            ->andFilterWhere(['like', 'VEH_COLOR', $this->VEH_COLOR])
            ->andFilterWhere(['like', 'VEH_PATENTE', $this->VEH_PATENTE]);

        return $dataProvider;
    }
}
