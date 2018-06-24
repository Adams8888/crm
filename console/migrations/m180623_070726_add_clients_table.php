<?php

use yii\db\Migration;

/**
 * Class m180623_070726_add_clients_table
 */
class m180623_070726_add_clients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%clients}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'country_id' => $this->integer()->notNull(),
            'payment_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'note' => $this->string(255),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_clients_1111_00','{{%clients}}', 'country_id', '{{%countries}}', 'id', 'NO ACTION', 'CASCADE' );
        $this->addForeignKey('fk_user_2222_02','{{%clients}}', 'user_id', '{{%user}}', 'id', 'NO ACTION', 'CASCADE' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%clients}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180623_070726_add_clients_table cannot be reverted.\n";

        return false;
    }
    */
}
