<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Empleado;

/**
 * EmpleadoSearch represents the model behind the search form about `app\models\Empleado`.
 */
class EmpleadoSearch extends Empleado
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EMP_RUT', 'EMP_NOMBRES', 'EMP_PATERNO', 'EMP_MATERNO'], 'safe'],
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
        $query = Empleado::find();

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
        $query->andFilterWhere(['like', 'EMP_RUT', $this->EMP_RUT])
            ->andFilterWhere(['like', 'EMP_NOMBRES', $this->EMP_NOMBRES])
            ->andFilterWhere(['like', 'EMP_PATERNO', $this->EMP_PATERNO])
            ->andFilterWhere(['like', 'EMP_MATERNO', $this->EMP_MATERNO]);

        return $dataProvider;
    }
}
