<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 13.08.18
 * Time: 15:07
 */

namespace shop\entities;


class Meta
{
    public $title;
    public $title_uk;
    public $description;
    public $description_uk;
    public $keywords;
    public $keywords_uk;

    public function __construct($title, $title_uk, $description, $description_uk, $keywords, $keywords_uk)
    {
        $this->title = $title;
        $this->title_uk = $title_uk;
        $this->description = $description;
        $this->description_uk = $description_uk;
        $this->keywords = $keywords;
        $this->keywords_uk = $keywords_uk;
    }
}