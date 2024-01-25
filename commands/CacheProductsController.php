<?php

namespace app\commands;

use app\models\Product;
use app\services\CacheService;
use yii\base\Exception;
use yii\console\Controller;
use yii\console\ExitCode;

class CacheProductsController extends Controller
{
    /**
     * @throws Exception
     */
    public function actionIndex(): int
    {
        $cacheService = new CacheService();

        $totalProductsCount = \Yii::$app->db
            ->createCommand('SELECT COUNT(*) as cnt FROM products')
            ->queryOne();

        $i     = 0;
        $chunk = 100;
        while($i < $totalProductsCount['cnt']) {
            $products = Product::find()->limit($chunk)->offset($i)->orderBy('id')->all();

            foreach ($products as $product) {
                $cacheService->hSet('products', $product->id, $product);
            }

            $i += $chunk;
        }

        return ExitCode::OK;
    }
}
