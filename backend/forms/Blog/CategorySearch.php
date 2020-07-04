<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 23:34
 */

namespace backend\forms\Blog;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\Blog\Category;

class CategorySearch extends Model
{
    public $id;
    public $name;
    public $slug;
    public $title;
    public $name_uk;
    public $slug_uk;
    public $title_uk;

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name', 'slug', 'title', 'name_uk', 'slug_uk', 'title_uk'], 'safe'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['sort' => SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
