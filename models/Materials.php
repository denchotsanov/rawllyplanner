<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%materials}}".
 *
 * @property int $id
 * @property string $name
 * @property int $unit_id
 * @property double $delivery_price
 * @property int $updated_at
 * @property int $created_at
 */
class Materials extends \yii\db\ActiveRecord
{
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
        return '{{%materials}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id', 'updated_at', 'created_at'], 'integer'],
            [['delivery_price'], 'number'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'unit_id' => 'Unit ID',
            'delivery_price' => 'Delivery Price',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Units::className(), ['id' => 'unit_id']);
    }


    public static function getList()
    {
        return ArrayHelper::map( self::find()->all(),'id','name');
    }
    public static function getByID($id=null){
        if(!$id){
            return false;
        }

        return self::findOne($id);
    }
    public static function getNameByID($id=null){
        if(!$id){
            return false;
        }

        return self::findOne($id)->name;
    }
}
