<?php

namespace console\seeder\tables;

use antonyz89\seeder\TableSeeder;
use app\models\Product;
use app\models\Tag;
use console\seeder\DatabaseSeeder;
use app\models\ProductTag;

/**
 * Handles the creation of seeder `product_tag`.
 */
class ProductTagTableSeeder extends TableSeeder
{
    /**
     * {@inheritdoc}
     */
    public function run(): void
    {
        $productIds = array_map(function (Product $item) {
            return $item->id;
        }, Product::find()->all());
        $regionIds  = array_map(function (Tag $item) {
            return $item->id;
        }, Tag::find()->all());

        loop(function ($i) use ($productIds, $regionIds) {
            $this->insert(ProductTag::tableName(), [
                'product_id' => $this->faker->randomElement($productIds),
                'tag_id'     => $this->faker->randomElement($regionIds),
            ]);
        }, 3500);
    }
}
