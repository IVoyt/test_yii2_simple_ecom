<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_tag}}`.
 */
class m240125_103551_create_product_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%product_tag}}', [
            'product_id' => $this->bigInteger()->unsigned(),
            'tag_id'     => $this->bigInteger()->unsigned(),
        ]);

        $this->addForeignKey(
            'product_tag_product_id',
            'product_tag',
            'product_id',
            'products',
            'id'
        );

        $this->addForeignKey(
            'product_tag_tag_id',
            'product_tag',
            'tag_id',
            'tags',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%product_tag}}');
    }
}
