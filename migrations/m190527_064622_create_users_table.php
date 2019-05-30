<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m190527_064622_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(255)->notNull(),
            'email' => $this->string(255)->notNull()->unique(),
            'password'=>$this->string(255),
            'authKey'=>$this->string(255),
            'accessToken'=>$this->string(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
