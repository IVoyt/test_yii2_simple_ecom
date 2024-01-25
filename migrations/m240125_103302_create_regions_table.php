<?php

use yii\db\Migration;

/**
 * Class m240125_103302_create_regions_tables
 */
class m240125_103302_create_regions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%regions}}', [
            'id'    => $this->bigPrimaryKey()->unsigned(),
            'title' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%regions}}');
    }
}
