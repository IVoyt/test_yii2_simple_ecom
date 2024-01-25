<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $title
 * @property string $path_id
 * @property string $path_title
 *
 * @property Category[] $categories
 * @property Category $parent
 * @property ProductCategory[] $productCategories
 */
class Category extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['parent_id'], 'integer'],
            [['title', 'path_id', 'path_title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['path_id', 'path_title'], 'string', 'max' => 1024],
            [
                ['parent_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Category::class,
                'targetAttribute' => ['parent_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id'         => 'ID',
            'parent_id'  => 'Parent ID',
            'title'      => 'Title',
            'path_id'    => 'Path ID',
            'path_title' => 'Path Title',
        ];
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return ActiveQuery
     */
    public function getCategories(): ActiveQuery
    {
        return $this->hasMany(Category::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return ActiveQuery
     */
    public function getParent(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[ProductCategories]].
     *
     * @return ActiveQuery
     */
    public function getProductCategories(): ActiveQuery
    {
        return $this->hasMany(ProductCategory::class, ['category_id' => 'id']);
    }
}
