<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%nutrition_value_relation}}".
 *
 * @property int $id
 * @property int $nutrition_value_id
 * @property int $product_id
 * @property double $value
 * @property string $description
 */
class NutritionValueRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%nutrition_value_relation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nutrition_value_id', 'product_id'], 'integer'],
            [['value'], 'number'],
            [['description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nutrition_value_id' => 'Name',
            'product_id' => 'Product',
            'value' => 'Value for 1 unit',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct(){
        return $this->hasOne(Products::class,['id'=>'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNutritionValue(){
        return $this->hasOne(NutritionValue::class,['id'=>'nutrition_value_id']);
    }
}
