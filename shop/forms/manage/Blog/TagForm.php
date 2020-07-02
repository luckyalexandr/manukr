<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 23:13
 */

namespace shop\forms\manage\Blog;

use shop\entities\Blog\Tag;
use shop\validators\SlugValidator;
use yii\base\Model;

class TagForm extends Model
{
    public $name;
    public $name_uk;
    public $slug;

    private $_tag;

    public function __construct(Tag $tag = null, $config = [])
    {
        if ($tag) {
            $this->name = $tag->name;
            $this->name = $tag->name_uk;
            $this->slug = $tag->slug;
            $this->_tag = $tag;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'name_uk', 'slug'], 'required'],
            [['name', 'name_uk', 'slug'], 'string', 'max' => 255],
            ['slug', SlugValidator::class],
            [['name', 'name_uk', 'slug'], 'unique', 'targetClass' => Tag::class, 'filter' => $this->_tag ? ['<>', 'id', $this->_tag->id] : null]
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'name_uk' => 'Имя Uk',
            'slug' => 'Транслит'
        ];
    }
}