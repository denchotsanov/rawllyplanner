<?php


namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

class RecipesNutritionValueSearch extends NutritionValueRelation
{
    public $material_id =[];
    public function rules()
    {
        return [
            [['id', 'nutrition_value_id', 'product_id','material_id'], 'integer'],
            [['value'], 'number'],
            [['description'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
    public function attributeLabels()
    {
        return [
            'nvname' => 'Name',
            'nvquantity' => 'Value for 1 unit',
        ];
    }
    public function search($params)
    {
        $query =(new Query())
            ->select("nvname, (sum( nvvalue )) as nvquantity")
            ->from((new Query())
                ->select("r.quantity as quan, m.name, nv.name AS nvname, (r.quantity * nvr.value) AS nvvalue")
                ->from('recipes_relation r')
                ->join('JOIN','materials m','r.materials_id = m.id')
                ->join('JOIN','nutrition_value_relation nvr','m.id = nvr.product_id')
                ->join('JOIN','nutrition_value nv','nv.id = nvr.nutrition_value_id')
            )->groupBy('nvname');

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
        $query->andWhere(['in','m.id',$this->material_id]);

        return $dataProvider;
    }
}