<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.07.18
 * Time: 13:42
 */
return [
   'class' => 'yii\web\UrlManager',
    // 'class' => 'codemix\localeurls\UrlManager',
    'hostInfo' => $params['frontendHostInfo'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'cache' => false,
    // 'languages' => ['uk', 'ru'],
    // 'enableDefaultLanguageUrlCode' => true,
    'rules' => [
        '' => 'site/index',
        'contact' => 'contact/index',
        'signup' => 'auth/signup/request',
        'signup/<_a:[\w-]+' => 'auth/signup/<_a>',
        '<_a:login|logout>' => 'auth/auth/<_a>',

        ['pattern' => 'sitemap', 'route' => 'sitemap/index', 'suffix' => '.xml'],
        ['pattern' => 'sitemap-<target:[a-z-]+>-<start:\d+>', 'route' => 'sitemap/<target>', 'suffix' => '.xml'],
        ['pattern' => 'sitemap-<target:[a-z-]+>', 'route' => 'sitemap/<target>', 'suffix' => '.xml'],

        'blog' => 'blog/post/index',
        'blog/tag/<slug:[\w\-]+>' => 'blog/post/tag',
        'blog/<id:\d+>' => 'blog/post/post',
        'blog/<id:\d+>/comment' => 'blog/post/comment',
        'blog/<slug:[\w\-]+>' => 'blog/post/category',

        'catalog' => 'shop/catalog/index',
//        'catalog/<slug:[\w\-]+>' => 'shop/catalog/<a_>',
        ['class' => 'frontend\urls\CategoryUrlRule'],
//        ['class' => 'frontend\urls\ProductUrlRule'],
        'catalog/<id:\d+>' => 'shop/catalog/product',
        'catalog/<slug:[\w\-]+>' => 'shop/catalog/slug-product',

        ['pattern' => 'catalog/merchant', 'route' => 'shop/catalog/merchant', 'suffix' => '.xml'],

        'cabinet' => 'cabinet/default/index',
        'cabinet/<_c:[\w\-]+>' => 'cabinet/<_c>/index',
        'cabinet/<_c:[\w\-]+>/<id:\d+>' => 'cabinet/<_c>/view',
        'cabinet/<_c:[\w\-]+>/<_a:[\w\-]+>' => 'cabinet/<_c>/<_a>',
        'cabinet/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => 'cabinet/<_c>/<_a>',

        ['class' => 'frontend\urls\PageUrlRule'],

        '<_c:[\w\-]+>' => '<_c>/index',
        '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
        '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<id:\d+>/<_a:[\w-]+>' => '<_c>/<_a>',
    ],
];