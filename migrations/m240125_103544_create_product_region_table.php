<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_region}}`.
 */
class m240125_103544_create_product_region_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%product_region}}', [
            'product_id' => $this->bigInteger()->unsigned(),
            'region_id'  => $this->bigInteger()->unsigned(),
        ]);

        $this->addForeignKey(
            'product_region_product_id',
            'product_region',
            'product_id',
            'products',
            'id'
        );

        $this->addForeignKey(
            'product_region_region_id',
            'product_region',
            'region_id',
            'regions',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%product_region}}');
    }
}
