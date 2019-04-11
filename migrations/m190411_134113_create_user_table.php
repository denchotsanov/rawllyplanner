<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m190411_134113_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255),
            'password' => $this->string(255),
            'email' => $this->string(255),
            'access_token' => $this->string(255),
            'forgotten_password_token' => $this->string(255),
            'is_active' => $this->boolean(),
            'updated_at' => $this->integer(),
            'created_at' => $this->integer()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
