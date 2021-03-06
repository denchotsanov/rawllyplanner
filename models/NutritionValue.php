<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%nutrition_value}}".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 */
class NutritionValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%nutrition_value}}';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'description' => 'Description',
        ];
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
