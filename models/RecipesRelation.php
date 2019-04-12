<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%recipes_relation}}".
 *
 * @property int $id
 * @property int $product_id
 * @property int $materials_id
 * @property double $quantity
 * @property int $unit_id
 *
 * @property Materials $materials
 * @property Products $product
 * @property Units $unit
 */
class RecipesRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%recipes_relation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'materials_id', 'unit_id'], 'integer'],
            [['quantity'], 'number'],
            [['materials_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materials::className(), 'targetAttribute' => ['materials_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Units::className(), 'targetAttribute' => ['unit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'materials_id' => 'Materials ID',
            'quantity' => 'Quantity',
            'unit_id' => 'Unit ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasOne(Materials::className(), ['id' => 'materials_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Units::className(), ['id' => 'unit_id']);
    }

    public function getTotalPrice(){
        if($this->unit_id == $this->materials->unit_id){
            return $this->quantity * $this->materials->delivery_price;
        }

        return null;
    }
}
