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
    public $valuePerOne;
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
            'value' => 'Value valid for 100 g',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial(){
        return $this->hasOne(Materials::class,['id'=>'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNutritionValue(){
        return $this->hasOne(NutritionValue::class,['id'=>'nutrition_value_id']);
    }

    public function beforeSave($insert)
    {
        $this->value = $this->value / 100;
        return parent::beforeSave($insert);
    }

    public function afterFind() {

        parent::afterFind();

        $this->valuePerOne = $this->value;
        $this->value = $this->value * 100;

    }

    public function getValueOnSto(){
        return $this->valuePerOne * 100;
    }
}
