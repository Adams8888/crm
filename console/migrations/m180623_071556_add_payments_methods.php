<?php

use yii\db\Migration;

/**
 * Class m180623_071556_add_payments_methods
 */
class m180623_071556_add_payments_methods extends Migration
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

        $this->createTable('{{%payment_methods}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull()->unique(),
            'type' => 'ENUM("PayPal", "Skrill", "Bank transfer")',
            'description' => $this->string(255)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_payment_1111_00','{{%clients}}', 'payment_id', '{{%payment_methods}}', 'id', 'NO ACTION', 'CASCADE' );
        $this->addForeignKey('fk_user_payment_3333_00','{{%payment_methods}}', 'user_id', '{{%user}}', 'id', 'NO ACTION', 'CASCADE' );


        $sql = "ALTER TABLE payment_methods ALTER type SET DEFAULT 'PayPal'";
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payment_methods}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180623_071556_add_payments_methods cannot be reverted.\n";

        return false;
    }
    */
}
