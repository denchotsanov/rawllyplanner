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
 * @property string $email
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
            [['address', 'description','email'], 'string'],
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
            'product_id' => 'Продукт',
            'text' => 'Допълнителна информация',
            'name' => 'Име',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'description' => 'Описание',
            'status' => 'Статус',
            'quantity' => 'Количество',
            'price' => 'Цена',
            'ready_to' => 'Дата за доставка',
            'delivered' => 'Доставено на',
            'updated_at' => 'Обновено на',
            'created_at' => 'Създадено на',
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
            $this->ready_to = Yii::$app->formatter->asTimestamp($this->ready_to);

            if($this->delivered!=''){
                $this->delivered = Yii::$app->formatter->asTimestamp($this->delivered);
            }

        return parent::beforeValidate();
    }

    public function afterFind(){
        if($this->delivered){

            $this->delivered = Yii::$app->formatter->asDatetime($this->delivered);
        }
        if($this->ready_to){
            $this->ready_to= Yii::$app->formatter->asDatetime($this->ready_to);
        }
        return parent::afterFind();
    }

    public function getDeliveryPrice(){
        if(!$this->product){
            return null;
        }
        return $this->product->getDeliveryPrice();
    }
}
