<?php

namespace console\seeder\tables;

use antonyz89\seeder\TableSeeder;
use app\models\Category;
use app\models\Product;
use console\seeder\DatabaseSeeder;
use app\models\ProductCategory;

/**
 * Handles the creation of seeder `product_category`.
 */
class ProductCategoryTableSeeder extends TableSeeder
{
    /**
     * {@inheritdoc}
     */
    public function run(): void
    {
        $productIds  = array_map(function (Product $item) {
            return $item->id;
        }, Product::find()->all());
        $categoryIds = array_map(function (Category $item) {
            return $item->id;
        }, Category::find()->all());

        loop(function ($i) use ($productIds, $categoryIds) {
            $this->insert(ProductCategory::tableName(), [
                'product_id'  => $this->faker->randomElement($productIds),
                'category_id' => $this->faker->randomElement($categoryIds),
            ]);
        }, 3500);
    }
}
