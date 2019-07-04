<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nutrition_value}}`.
 */
class m190704_152624_create_nutrition_value_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nutrition_value}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'description' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%nutrition_value}}');
    }
}
