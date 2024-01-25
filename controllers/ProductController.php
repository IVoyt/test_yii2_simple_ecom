<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductSearch;
use app\services\CacheService;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public $layout = 'product';

    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only'  => ['index', 'view'],
                    'rules' => [
                        [
                            'actions' => ['index', 'view'],
                            'allow'   => true,
                            'roles'   => ['@'],
                        ],
                    ],
                ],
                'verbs'  => [
                    'class'   => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $pageSize     = 20;
        $cacheService = new CacheService();
        $searchModel  = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $cachedProducts = $cacheService->hGetAll('products', Product::class);

        if (!empty($cachedProducts)) {
            $page = (\Yii::$app->request->get('page') ?? 1);
            $offset = ($page - 1) * $pageSize;
            $products   = array_slice($cachedProducts, $offset, $pageSize);
            $totalCount = count($cachedProducts);
        } else {
            $products   = $dataProvider->getModels();
            $totalCount = $dataProvider->query->count();

            foreach ($products as $product) {
                $cacheService->hSet('products', $product->id, $product);
            }
        }

        $paginator = new Pagination(['totalCount' => $totalCount, 'pageSize' => $pageSize]);

        return $this->render('index', [
            'paginator' => $paginator,
            'products'  => $products
        ]);
    }

    /**
     * Displays a single Product model.
     *
     * @param int $id ID
     *
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'product' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id ID
     *
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Product
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Данный продукт не найлен!');
    }
}
