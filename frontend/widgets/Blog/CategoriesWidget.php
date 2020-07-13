<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:40
 */

namespace frontend\widgets\Blog;

use shop\entities\Blog\Category;
use shop\fetching\Blog\CategoryFetchingRepository;
use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class CategoriesWidget extends Widget
{
    /** @var Category|null */
    public $active;

    private $categories;

    public function __construct(CategoryFetchingRepository $categories, $config = [])
    {
        parent::__construct($config);
        $this->categories = $categories;
    }

    public function run(): string
    {
        return Html::tag('div', implode(PHP_EOL, array_map(function (Category $category) {
            $active = $this->active && ($this->active->id == $category->id);
            return Html::a(
                Html::encode(Yii::$app->language == 'ru' ? $category->name : $category->name_uk),
                ['/blog/post/category', 'slug' => $category->slug],
                ['class' => $active ? 'list-group-item active' : 'list-group-item']
            );
        }, $this->categories->getAll())), [
            'class' => 'list-group',
        ]);
    }
}