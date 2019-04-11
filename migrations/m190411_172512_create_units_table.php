<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%units}}`.
 */
class m190411_172512_create_units_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%units}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(255),
            'updated_at' => $this->integer(),
            'created_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%units}}');
    }
}
