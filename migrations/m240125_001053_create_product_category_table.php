<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_category}}`.
 */
class m240125_001053_create_product_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%product_category}}', [
            'product_id' => $this->bigInteger()->unsigned()->notNull(),
            'category_id' => $this->bigInteger()->unsigned()->notNull(),
        ]);

        $this->addForeignKey(
            'product_category_product_id',
            'product_category',
            'product_id',
            'products',
            'id'
        );

        $this->addForeignKey(
            'product_category_category_id',
            'product_category',
            'category_id',
            'categories',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%product_category}}');
    }
}
