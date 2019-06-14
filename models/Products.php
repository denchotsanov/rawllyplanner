<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $product_name
 * @property int $updated_at
 * @property int $created_at
 */
class Products extends \yii\db\ActiveRecord
{

    public static function getList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'product_name');
    }

    public static function getByID($id = null)
    {
        if (!$id) {
            return false;
        }

        return self::findOne($id);
    }

    public static function getNameByID($id = null)
    {
        if (!$id) {
            return false;
        }

        return self::findOne($id)->product_name;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_at', 'created_at'], 'integer'],
            [['product_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => 'Product Name',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    public function getRecipe(){
        return $this->hasMany(RecipesRelation::className(),['product_id'=>'id']);
    }

    public function getDeliveryPrice(){
        if($this->recipe){
            $price = 0;
                foreach($this->recipe as $material){
                    if($material->totalPrice){
                        $price += $material->totalPrice;
                    }
            }

            return $price;
        }
        return null;
    }
}
