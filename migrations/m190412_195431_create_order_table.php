<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m190412_195431_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer(),
            'text'=>$this->string(150),
            'name' =>$this->string(255),
            'phone' =>$this->string(20),
            'address'=>$this->text(),
            'description'=>$this->text(),
            'status'=>$this->integer(),
            'quantity'=>$this->integer(),
            'price'=>$this->float(),
            'ready_to'=>$this->integer(),
            'delivered'=>$this->integer(),
            'updated_at' => $this->integer(),
            'created_at' => $this->integer()
        ]);
        $this->addForeignKey(
            'fk-order-product_id',
            '{{%order}}',
            'product_id',
            '{{%products}}',
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
            'fk-order-product_id',
            '{{%order}}'
        );
        $this->dropTable('{{%order}}');
    }
}
