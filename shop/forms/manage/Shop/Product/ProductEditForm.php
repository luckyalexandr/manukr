<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.01.19
 * Time: 2:51
 */

namespace shop\forms\manage\Shop\Product;


use shop\entities\Shop\Brand;
use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Product\Product;
use shop\forms\CompositeForm;
use shop\forms\manage\MetaForm;
use shop\validators\SlugValidator;
use yii\helpers\ArrayHelper;

/**
 * Class ProductCreateForm
 * @package shop\forms\manage\Shop\Product
 *
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class ProductEditForm extends CompositeForm
{
    public $brandId;
    public $code;
    public $name;
    public $slug;
    public $description;
    public $name_uk;
    public $slug_uk;
    public $description_uk;

    private $_product;

    public function __construct(Product $product, $config = [])
    {
        $this->brandId = $product->brand_id;
        $this->code = $product->code;
        $this->name = $product->name;
        $this->name_uk = $product->name_uk;
        $this->slug = $product->slug;
        $this->slug_uk = $product->slug_uk;
        $this->description = $product->description;
        $this->description_uk = $product->description_uk;
        $this->meta = new MetaForm($product->meta);
        $this->categories = new CategoriesForm($product);
        $this->tags = new TagsForm($product);
        $this->values = array_map(function (Characteristic $characteristic) use ($product) {
            return new ValueForm($characteristic, $product->getValue($characteristic->id));
        }, Characteristic::find()->orderBy('sort')->all());
        $this->_product = $product;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['brandId', 'code', 'name', 'name_uk'], 'required'],
            [['code', 'name', 'slug'], 'string', 'max' => 255],
            [['brandId'], 'integer'],
            ['slug', SlugValidator::class],
            [['code', 'slug', 'slug_uk'], 'unique', 'targetClass' => Product::class, 'filter' => $this->_product ? ['<>', 'id', $this->_product->id] : null],
            [['description', 'description_uk'], 'string'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'brandId' => 'Бренд',
            'code' => 'Артикул',
            'name' => 'Наименование',
            'slug' => 'URL',
            'description' => 'Описание',
            'name_uk' => 'Наименование Uk',
            'slug_uk' => 'URL Uk',
            'description_uk' => 'Описание Uk',
        ];
    }

    public function brandsList(): array
    {
        return ArrayHelper::map(Brand::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    protected function internalForms(): array
    {
        return ['meta', 'categories', 'tags', 'values'];
    }
}