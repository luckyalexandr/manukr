<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 23:25
 */

namespace shop\services\manage\Blog;

use shop\entities\Blog\Tag;
use shop\forms\manage\Blog\TagForm;
use shop\repositories\Blog\TagRepository;

class TagManageService
{
    private $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    public function create(TagForm $form): Tag
    {
        $tag = Tag::create(
            $form->name,
            $form->name_uk,
            $form->slug
        );
        $this->tags->save($tag);
        return $tag;
    }

    public function edit($id, TagForm $form): void
    {
        $tag = $this->tags->get($id);
        $tag->edit(
            $form->name,
            $form->name_uk,
            $form->slug
        );
        $this->tags->save($tag);
    }

    public function remove($id): void
    {
        $tag = $this->tags->get($id);
        $this->tags->remove($tag);
    }
}