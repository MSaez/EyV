<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form about `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['US_ID'], 'integer'],
            [['US_USERNAME', 'US_RUT', 'US_NOMBRES', 'US_PATERNO', 'US_MATERNO', 'US_EMAIL', 'US_PASSWORD', 'US_AUTHKEY'], 'safe'],
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
        $query = Usuario::find();

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
            'US_ID' => $this->US_ID,
        ]);

        $query->andFilterWhere(['like', 'US_USERNAME', $this->US_USERNAME])
            ->andFilterWhere(['like', 'US_RUT', $this->US_RUT])
            ->andFilterWhere(['like', 'US_NOMBRES', $this->US_NOMBRES])
            ->andFilterWhere(['like', 'US_PATERNO', $this->US_PATERNO])
            ->andFilterWhere(['like', 'US_MATERNO', $this->US_MATERNO])
            ->andFilterWhere(['like', 'US_EMAIL', $this->US_EMAIL])
            ->andFilterWhere(['like', 'US_PASSWORD', $this->US_PASSWORD])
            ->andFilterWhere(['like', 'US_AUTHKEY', $this->US_AUTHKEY]);

        return $dataProvider;
    }
}
