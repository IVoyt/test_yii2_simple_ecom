<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m240125_001043_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%categories}}', [
            'id'         => $this->bigPrimaryKey()->unsigned(),
            'parent_id'  => $this->bigInteger()->unsigned()->null(),
            'title'      => $this->string()->notNull(),
            'path_id'    => $this->string(1024)->notNull(),
            'path_title' => $this->string(1024)->notNull(),
        ]);

        $this->addForeignKey(
            'categories_parent_id',
            'categories',
            'parent_id',
            'categories',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%categories}}');
    }
}
