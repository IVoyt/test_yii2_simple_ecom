<?php

use app\models\Product;

/**
 * @var yii\web\View $this
 * @var Product $product
 * @var bool $clickable
 */
?>

<div class="col">
    <div class="product-item">
        <h5>
            <span class="badge bg-success position-absolute m-3">
                -<?= round($product->price / $product->discount_price, 2) ?>%
            </span>
        </h5>
        <figure>
            <?php if($clickable) : ?>
                <a href="/products/<?= $product->id ?>" title="Product Title">
                    <img src="" alt="" style="width: 100%" class="tab-image">
                </a>
            <?php else : ?>
                <img src="" alt="" style="width: 100%" class="tab-image">
            <?php endif; ?>
        </figure>
        <h3><?= $product->title ?></h3>
        <span class="qty"><?= $product->stock ?> Unit</span>
        <span class="price">$<?= $product->price ?></span>
        <?php if ($product->categories): ?>
            <hr>
            <div class="categories">
                Categories:
                <?php foreach ($product->categories as $category): ?>
                    <h6 style="display: inline">
                        <span class="category badge bg-primary text-dark"><?= $category->title ?></span>
                    </h6>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if ($product->tags): ?>
            <hr>
            <div class="tags">
                Tags:
                <?php foreach ($product->tags as $tag): ?>
                    <h6 style="display: inline">
                        <span class="tag badge bg-info text-dark"><?= $tag->title ?></span>
                    </h6>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <hr>
        <span class="region">Region: <?= $product->region->title ?></span>
    </div>
</div>
