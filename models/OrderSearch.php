<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order
{
    public $statusRange=null;
    public $readyDate=null;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'status', 'quantity',  'updated_at', 'created_at'], 'integer'],
            [['text', 'name', 'phone', 'address','ready_to', 'delivered', 'description','statusRange','readyDate'], 'safe'],
            [['price'], 'number'],
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
        $query = Order::find();

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
            'product_id' => $this->product_id,
            'status' => $this->status,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'description', $this->description]);

        if($this->readyDate || $this->statusRange){
            $query->andFilterWhere(['in','status',$this->statusRange])
                ->andFilterWhere(['between', 'ready_to', strtotime(date('d.m.Y 00:00',$this->readyDate)), strtotime(date('d.m.Y 23:59',$this->readyDate))]);
        }
        return $dataProvider;
    }
}
