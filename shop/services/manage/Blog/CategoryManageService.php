<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 23:24
 */

namespace shop\services\manage\Blog;

use shop\entities\Meta;
use shop\entities\Blog\Category;
use shop\forms\manage\Blog\CategoryForm;
use shop\repositories\Blog\CategoryRepository;
use shop\repositories\Blog\PostRepository;

class CategoryManageService
{
    private $categories;
    private $posts;

    public function __construct(CategoryRepository $categories, PostRepository $posts)
    {
        $this->categories = $categories;
        $this->posts = $posts;
    }

    public function create(CategoryForm $form): Category
    {
        $category = Category::create(
            $form->name,
            $form->name_uk,
            $form->slug,
            $form->slug_uk,
            $form->title,
            $form->title_uk,
            $form->description,
            $form->description_uk,
            $form->sort,
            new Meta(
                $form->meta->title,
                $form->meta->title_uk,
                $form->meta->description,
                $form->meta->description_uk,
                $form->meta->keywords,
                $form->meta->keywords_uk
            )
        );
        $this->categories->save($category);
        return $category;
    }

    public function edit($id, CategoryForm $form): void
    {
        $category = $this->categories->get($id);
        $category->edit(
            $form->name,
            $form->name_uk,
            $form->slug,
            $form->slug_uk,
            $form->title,
            $form->title_uk,
            $form->description,
            $form->description_uk,
            $form->sort,
            new Meta(
                $form->meta->title,
                $form->meta->title_uk,
                $form->meta->description,
                $form->meta->description_uk,
                $form->meta->keywords,
                $form->meta->keywords_uk
            )
        );
        $this->categories->save($category);
    }

    public function remove($id): void
    {
        $category = $this->categories->get($id);
        if ($this->posts->existsByCategory($category->id)) {
            throw new \DomainException('Unable to remove category with posts.');
        }
        $this->categories->remove($category);
    }
}