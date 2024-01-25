<?php

namespace console\seeder\tables;

use antonyz89\seeder\TableSeeder;
use console\seeder\DatabaseSeeder;
use app\models\Tag;

/**
 * Handles the creation of seeder `tags`.
 */
class TagTableSeeder extends TableSeeder
{
    /**
     * {@inheritdoc}
     */
    public function run(): void
    {
        loop(function ($i) {
            $this->insert(Tag::tableName(), [
                'title' => $this->faker->word,
            ]);
        }, 20);
    }
}
