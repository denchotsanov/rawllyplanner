<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%materials}}`.
 */
class m190411_172607_create_materials_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%materials}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255),
            'unit_id'=>$this->integer(),
            'delivery_price'=> $this->float(),
            'updated_at' => $this->integer(),
            'created_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%materials}}');
    }
}
