<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 12.12.18
 * Time: 12:47
 */

namespace shop\forms\manage\Shop;


use shop\entities\Shop\Characteristic;
use shop\helpers\CharacteristicHelper;
use yii\base\Model;

/**
 * Class CharacteristicForm
 * @package shop\forms\manage\Shop
 *
 * @property array $variants
 */
class CharacteristicForm extends Model
{
    public $name;
    public $name_uk;
    public $type;
    public $required;
    public $default;
    public $default_uk;
    public $textVariants;
    public $textVariants_uk;
    public $sort;

    private $_characteristic;

    public function __construct(Characteristic $characteristic = null, $config = [])
    {
        if ($characteristic) {
            $this->name = $characteristic->name;
            $this->name = $characteristic->name_uk;
            $this->type = $characteristic->type;
            $this->required = $characteristic->required;
            $this->default = $characteristic->default;
            $this->default = $characteristic->default_uk;
            $this->textVariants = implode(PHP_EOL, $characteristic->variants);
            $this->textVariants_uk = implode(PHP_EOL, $characteristic->variants_uk);
            $this->sort = $characteristic->sort;
            $this->_characteristic = $characteristic;
        } else {
            $this->sort = Characteristic::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'name_uk', 'type', 'sort'], 'required'],
            [['required'], 'boolean'],
            [['default', 'default_uk'], 'string', 'max' => 255],
            [['textVariants', 'textVariants_uk'], 'string'],
            [['sort'], 'integer'],
            [['name', 'name_uk'], 'unique', 'targetClass' => Characteristic::class, 'filter' => $this->_characteristic ? ['<>', 'id', $this->_characteristic->id] : null]
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Наименование',
            'name_uk' => 'Наименование Uk',
            'type' => 'Тип',
            'sort' => 'Сортировка',
            'required' => 'Обязательно',
            'textVariants' => 'Варианты',
            'default' => 'По умолчанию',
            'textVariants_uk' => 'Варианты Uk',
            'default_uk' => 'По умолчанию Uk',
        ];
    }

    public function typesList(): array
    {
        return CharacteristicHelper::typeList();
    }

    public function getVariants(): array
    {
        return preg_split('#\s+#i', $this->textVariants);
    }

    public function getVariantsUk(): array
    {
        return preg_split('#\s+#i', $this->textVariants_uk);
    }
}