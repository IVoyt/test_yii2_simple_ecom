<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property int               $id
 * @property string            $slug
 * @property string            $title
 * @property float             $price
 * @property float             $discount_price
 * @property int               $stock
 *
 * @property Category[]        $categories
 * @property ProductCategory[] $productCategories
 * @property ProductRegion     $productRegion
 * @property ProductTag[]      $productTags
 * @property Region            $region
 * @property Tag[]             $tags
 */
class Product extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['slug', 'title'], 'required'],
            [['slug', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id'    => 'ID',
            'slug'  => 'Slug',
            'title' => 'Title',
        ];
    }

    public function getCategories(): ActiveQuery
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->via('productCategories');
    }

    public function getProductCategories(): ActiveQuery
    {
        return $this->hasMany(ProductCategory::class, ['product_id' => 'id']);
    }

    public function getProductRegion(): ActiveQuery
    {
        return $this->hasOne(ProductRegion::class, ['product_id' => 'id']);
    }

    public function getRegion(): ActiveQuery
    {
        return $this->hasOne(Region::class, ['id' => 'region_id'])
            ->via('productRegion');
    }

    public function getProductTags(): ActiveQuery
    {
        return $this->hasMany(ProductTag::class, ['product_id' => 'id']);
    }

    public function getTags(): ActiveQuery
    {
        return $this->hasMany(Region::class, ['id' => 'tag_id'])
            ->via('productTags');
    }
}
