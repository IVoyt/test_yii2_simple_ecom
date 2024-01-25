<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m240125_000850_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%products}}', [
            'id'             => $this->bigPrimaryKey()->unsigned(),
            'slug'           => $this->string()->notNull(),
            'title'          => $this->string()->notNull(),
            'price'          => $this->float()->unsigned()->notNull(),
            'discount_price' => $this->float()->null(),
            'stock'          => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%products}}');
    }
}
