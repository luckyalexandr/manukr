<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 10.12.18
 * Time: 9:28
 */

namespace shop\services\manage\Shop;

use shop\entities\Meta;
use shop\entities\Shop\Category;
use shop\forms\manage\Shop\CategoryForm;
use shop\repositories\Shop\CategoryRepository;
use shop\repositories\Shop\ProductRepository;

class CategoryManageService
{
    private $categories;
    private $products;

    public function __construct(CategoryRepository $categories, ProductRepository $products)
    {
        $this->categories = $categories;
        $this->products = $products;
    }

    public function create(CategoryForm $form): Category
    {
        $parent = $this->categories->get($form->parentId);
        $category = Category::create(
            $form->name,
            $form->name_uk,
            $form->slug,
            $form->slug_uk,
            $form->title,
            $form->title_uk,
            $form->description,
            $form->description_uk,
            new Meta(
                $form->meta->title,
                $form->meta->title_uk,
                $form->meta->description,
                $form->meta->description_uk,
                $form->meta->keywords,
                $form->meta->keywords_uk
            )
        );
        $category->appendTo($parent);
        $this->categories->save($category);
        return $category;
    }

    public function edit($id, CategoryForm $form): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $category->edit(
            $form->name,
            $form->name_uk,
            $form->slug,
            $form->slug_uk,
            $form->title,
            $form->title_uk,
            $form->description,
            $form->description_uk,
            new Meta(
                $form->meta->title,
                $form->meta->title_uk,
                $form->meta->description,
                $form->meta->description_uk,
                $form->meta->keywords,
                $form->meta->keywords_uk
            )
        );
        if ($form->parentId !== $category->parent->id) {
            $parent = $this->categories->get($form->parentId);
            $category->appendTo($parent);
        }
        $this->categories->save($category);
    }

    public function moveUp($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($prev = $category->prev) {
            $category->insertBefore($prev);
        }
        $this->categories->save($category);
    }

    public function moveDown($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($next = $category->next) {
            $category->insertAfter($next);
        }
        $this->categories->save($category);
    }

    public function remove($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($this->products->existsByMainCategory($category->id)) {
            throw new \DomainException('Невозможно удалить категорию с товарами.');
        }
        $this->categories->remove($category);
    }

    private function assertIsNotRoot(Category $category): void
    {
        if ($category->isRoot()) {
            throw new \DomainException('Нельзя удалить корневую категорию.');
        }
    }
}