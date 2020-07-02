<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 12.08.18
 * Time: 17:20
 */

namespace shop\forms\manage\Shop;


use shop\entities\Shop\Tag;
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
            [['name', 'name_uk', 'slug'], 'unique', 'targetClass' => Tag::class],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Наименование',
            'name_uk' => 'Наименование Uk',
            'slug' => 'Транслит',
        ];
    }
}