<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%recipes}}`.
 */
class m190411_172631_create_recipes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%recipes}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255),

            'updated_at' => $this->integer(),
            'created_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%recipes}}');
    }
}
