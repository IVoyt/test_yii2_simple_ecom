<?php

namespace console\seeder\tables;

use antonyz89\seeder\TableSeeder;
use console\seeder\DatabaseSeeder;
use app\models\Category;

/**
 * Handles the creation of seeder `categories`.
 */
class CategoryTableSeeder extends TableSeeder
{
    /**
     * {@inheritdoc}
     */
    public function run(): void
    {
        loop(function ($i) {
            $parentId = $i < 3
                ? null
                : $this->faker->numberBetween(1, \Yii::$app->db->getLastInsertID());

            try {
                $this->insert(Category::tableName(), [
                    'parent_id'  => $parentId ?: null,
                    'title'      => $this->faker->word,
                    'path_id'    => $this->faker->text,
                    'path_title' => $this->faker->text,
                ]);
            } catch (\Throwable $e) {
                var_dump(\Yii::$app->db->getLastInsertID()); die;
            }
        }, 10);
    }
}
