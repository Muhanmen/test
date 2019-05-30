<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rooms}}`.
 */
class m190530_044414_create_rooms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rooms}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(255)->notNull()->unique(),
            "user_id" => $this->integer()->notNull()
        ]);

        $this->createIndex('{{%idx-rooms-user_id}}', '{{%rooms}}', 'user_id');
        $this->addForeignKey('{{%fk-rooms-user_id}}', '{{%rooms}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rooms}}');
    }
}
