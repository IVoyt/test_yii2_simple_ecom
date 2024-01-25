<?php

use app\assets\ProductAsset;
use yii\web\View;

/** @var yii\web\View $this */
/** @var app\models\Product $product */

$this->title = $product->title;

$id = $product->id - 1;

ProductAsset::register($this);

$script = <<<SCRIPT
    let elm = $('.tab-image')[0];
    $(elm).attr('src', `https://picsum.photos/id/${id}/600/480`);
SCRIPT;

$this->registerJs($script, View::POS_END);
?>
<div class="product-view m-auto">

    <div class="m-auto" style="max-width: 500px">
        <?php echo $this->render('_grid', ['product' => $product, 'clickable' => false]); ?>
    </div>

</div>
