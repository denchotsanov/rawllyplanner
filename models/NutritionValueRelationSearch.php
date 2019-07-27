<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NutritionValueRelation;

/**
 * NutritionValueRelationSearch represents the model behind the search form of `app\models\NutritionValueRelation`.
 */
class NutritionValueRelationSearch extends NutritionValueRelation
{

    public $material_id =[];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nutrition_value_id', 'product_id','material_id'], 'integer'],
            [['value'], 'number'],
            [['description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = NutritionValueRelation::find();

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
            'id' => $this->id,
            'nutrition_value_id' => $this->nutrition_value_id,
            'product_id' => $this->product_id,
            'value' => $this->value,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);
        return $dataProvider;
    }
}
