<?php

use app\assets\ProductAsset;
use yii\data\Pagination;
use app\models\Product;
use yii\web\View;
use yii\bootstrap5\LinkPager;

/**
 * @var View       $this
 * @var Product[]  $products
 * @var Pagination $paginator
 */

$this->title = 'Products';

ProductAsset::register($this);

$itemsCount = count($products);
$page       = $paginator->page + 1;

$script = <<<SCRIPT
    const itemsCount = $itemsCount;
    const page = $page;
    console.log(`https://picsum.photos/v2/list?limit=${itemsCount}&page=${page}`);
    $.ajax({
        url: `https://picsum.photos/v2/list?limit=${itemsCount}&page=${page}`,
        dataType: 'json',
        success: function(data) {
            data.forEach(function (item, key) {
                let imageParts = item.download_url.split('/');
                imageParts = imageParts.slice(0, -2);
                let image = imageParts.join('/') + '/600/480';
                let elm = $('.tab-image')[key];
                if (typeof elm !== 'undefined') {
                    $(elm).attr('src', `\${image}`);
                }
            });
        }
    });
SCRIPT;

$this->registerJs($script, View::POS_END);

?>
<div class="product-index">

    <section>
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <div class="bootstrap-tabs product-tabs">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active"
                                 id="nav-all"
                                 role="tabpanel"
                                 aria-labelledby="nav-all-tab">

                                <div class="product-grid row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-4">
                                    <?php foreach ($products as $product) {
                                        echo $this->render('_grid', ['product' => $product, 'clickable' => true]);
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <?php echo LinkPager::widget(['pagination' => $paginator]); ?>
        </div>
    </section>

</div>
