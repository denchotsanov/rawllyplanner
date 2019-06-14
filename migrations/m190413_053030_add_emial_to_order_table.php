<?php

use yii\db\Migration;

/**
 * Class m190413_053030_add_emial_to_order_table
 */
class m190413_053030_add_emial_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%order}}', 'email', $this->string(25));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%order}}', 'email');
    }
}
