<?php

namespace console\seeder\tables;

use antonyz89\seeder\TableSeeder;
use app\models\Product;
use app\models\Region;
use console\seeder\DatabaseSeeder;
use app\models\ProductRegion;

/**
 * Handles the creation of seeder `product_region`.
 */
class ProductRegionTableSeeder extends TableSeeder
{
    /**
     * {@inheritdoc}
     */
    public function run(): void
    {
        $productIds = array_map(function (Product $item) {
            return $item->id;
        }, Product::find()->all());
        $regionsIds = array_map(function (Region $item) {
            return $item->id;
        }, Region::find()->all());

        loop(function ($i) use ($productIds, $regionsIds) {
            $this->insert(ProductRegion::tableName(), [
                'product_id' => $productIds[$i - 1],
                'region_id'  => $this->faker->randomElement($regionsIds),
            ]);
        }, count($productIds));
    }
}
