<?php

namespace console\seeder\tables;

use antonyz89\seeder\TableSeeder;
use console\seeder\DatabaseSeeder;
use app\models\Region;

/**
 * Handles the creation of seeder `regions`.
 */
class RegionTableSeeder extends TableSeeder
{
    /**
     * {@inheritdoc}
     */
    public function run(): void
    {
        loop(function ($i) {
            $this->insert(Region::tableName(), [
                'title' => $this->faker->city,
            ]);
        }, 25);
    }
}
