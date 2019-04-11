<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%recipes_relation}}`.
 */
class m190411_173158_create_recipes_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%recipes_relation}}', [
            'id' => $this->primaryKey(),
            'product_id'=> $this->integer(),
            'materials_id'=> $this->integer(),
            'quantity'=>$this->float(),
            'unit_id'=> $this->integer()
        ]);
        $this->addForeignKey(
            'fk-recipe-product_id',
            'recipes_relation',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-recipe-materials_id',
            'recipes_relation',
            'materials_id',
            'materials',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-recipe-unit_id',
            'recipes_relation',
            'unit_id',
            'units',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-recipe-unit_id',
            'recipes_relation'
        );
        $this->dropForeignKey(
            'fk-recipe-materials_id',
            'recipes_relation'
        );
        $this->dropForeignKey(
            'fk-recipe-product_id',
            'recipes_relation'
        );
        $this->dropTable('{{%recipes_relation}}');
    }
}
