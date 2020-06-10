<?php
namespace frontend\urls;

use shop\entities\Shop\Product\Product;
use shop\fetching\Shop\ProductFetchingRepository;
use yii\base\BaseObject;
use yii\base\InvalidParamException;
use yii\caching\Cache;
use yii\caching\TagDependency;
//use yii\helpers\ArrayHelper;
use yii\web\UrlNormalizerRedirectException;
use yii\web\UrlRuleInterface;

class ProductUrlRule  extends BaseObject implements UrlRuleInterface {
    public $prefix = 'catalog';

    private $repository;
    private $cache;

    public function __construct(ProductFetchingRepository $repository, Cache $cache, $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
        $this->cache = $cache;
    }

    public function parseRequest($manager, $request)
    {
        if (preg_match('#^' . $this->prefix . '/(.*[a-z])$#is', $request->pathInfo, $matches)) {
            $path = $matches['1'];

            $result = $this->cache->getOrSet(['product_route', 'path' => $path], function () use ($path) {
                if (!$product = $this->repository->findBySlug($this->getPathSlug($path))) {
                    return ['id' => null, 'path' => null];
                }
                return ['id' => $product->id, 'path' => $this->getProductPath($product)];
            }, null, new TagDependency(['tags' => ['products']]));

            if (empty($result['id'])) {
                return false;
            }

            if ($path != $result['path']) {
                throw new UrlNormalizerRedirectException(['shop/catalog/product', 'id' => $result['id']], 301);
            }

            return ['shop/catalog/product', ['id' => $result['id']]];
        }
        return false;
    }

    public function createUrl($manager, $route, $params)
    {
        if ($route == 'shop/catalog/product') {
            if (empty($params['id'])) {
                throw new InvalidParamException('Empty id.');
            }
            $id = $params['id'];

            $url = $this->cache->getOrSet(['product_route', 'id' => $id], function () use ($id) {
                if (!$product = $this->repository->find($id)) {
                    return null;
                }
                return $this->getProductPath($product->slug);
            }, null, new TagDependency(['tags' => ['products']]));

            if (!$url) {
                throw new InvalidParamException('Undefined id.');
            }

            $url = $this->prefix . '/' . $url;
            unset($params['id']);
            if (!empty($params) && ($query = http_build_query($params)) !== '') {
                $url .= '?' . $query;
            }

            return $url;
        }
        return false;
    }

    private function getPathSlug($path): string
    {
        $chunks = explode('/', $path);
        return end($chunks);
    }

    private function getProductPath(Product $product): string
    {
        $chunks = $product->slug;
        return $chunks;
    }
}