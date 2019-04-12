<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string $text
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $description
 * @property int $status
 * @property int $quantity
 * @property double $price
 * @property int $ready_to
 * @property int $delivered
 * @property int $updated_at
 * @property int $created_at
 *
 * @property Products $product
 */
class Order extends \yii\db\ActiveRecord
{
    const REJECT = 0;
    const CREATE = 1;
    const IN_PROGRESS = 2;
    const READY = 3;
    const DELIVERED =4;

    public static $statuses = [
        self::REJECT => 'Rejected',
        self::CREATE => 'Create',
        self::IN_PROGRESS => 'In progress',
        self::READY => 'Ready',
        self::DELIVERED => 'Delivered',

    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order}}';
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
    public function rules()
    {
        return [
            [['product_id', 'status', 'quantity',  'updated_at', 'created_at'], 'integer'],
            [['ready_to', 'delivered'],'safe'],
            [['address', 'description'], 'string'],
            [['price'], 'number'],
            [['status'],'in','range' => [self::REJECT,self::CREATE,self::IN_PROGRESS,self::READY, self::DELIVERED]],
            [['text'], 'string', 'max' => 150],
            [['name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['name','phone','product_id', 'status', 'quantity', 'ready_to','address','price'],'required'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product',
            'text' => 'Additional Text',
            'name' => 'Name',
            'phone' => 'Phone',
            'address' => 'Address',
            'description' => 'Description',
            'status' => 'Status',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'ready_to' => 'Ready To',
            'delivered' => 'Delivered',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    public function beforeValidate(){
            $this->ready_to = strtotime($this->ready_to);

            if($this->delivered!=''){
                $this->delivered = strtotime($this->delivered);
            }

        return parent::beforeValidate();
    }

    public function afterFind(){
        if($this->delivered){
            $this->delivered = date('d.m.Y H:i',$this->delivered);
        }
        if($this->ready_to){
            $this->ready_to= date('d.m.Y H:i',$this->ready_to);
        }
        return parent::afterFind();
    }

    public function getDeliveryPrice(){
        return $this->product->getDeliveryPrice();
    }
}
