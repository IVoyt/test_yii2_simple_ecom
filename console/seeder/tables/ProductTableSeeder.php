<?php

namespace console\seeder\tables;

use antonyz89\seeder\TableSeeder;
use console\seeder\DatabaseSeeder;
use app\models\Product;

/**
 * Handles the creation of seeder `products`.
 */
class ProductTableSeeder extends TableSeeder
{
    /**
     * {@inheritdoc}
     */
    public function run(): void
    {
        loop(function ($i) {
            $price = $this->faker->randomFloat(4, 0.01, 9999.99);
            $this->insert(Product::tableName(), [
                'slug'           => $this->faker->slug,
                'title'          => $this->faker->jobTitle,
                'price'          => $price,
                'discount_price' => $this->faker->randomFloat(4, null, $price),
                'stock'          => $this->faker->numberBetween(0, 99)
            ]);
        }, 1500);
    }
}
