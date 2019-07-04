<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nutrition_value_relation}}`.
 */
class m190704_152825_create_nutrition_value_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nutrition_value_relation}}', [
            'id' => $this->primaryKey(),
            'nutrition_value_id' => $this->integer(),
            'product_id'=> $this->integer(),
            'value'=>$this->float(),
            'description' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%nutrition_value_relation}}');
    }
}
