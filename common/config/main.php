<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => [
        'common\bootstrap\SetUp',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => '{{%auth_items}}',
            'itemChildTable' => '{{%auth_item_children}}',
            'assignmentTable' => '{{%auth_assignments}}',
            'ruleTable' => '{{%auth_rules}}',
        ],
        'i18n' => [
            'translations' => [
                'areas' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'ua-UA',
                    'fileMap' => [
                        'areas' => 'areas.php',
                    ]
                ],
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'app' => 'app.php',
                    ]
                ],
                'login' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'login' => 'login.php',
                    ]
                ],
                'models' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'models' => 'models.php',
                    ]
                ],
                'blog' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'blog' => 'blog.php',
                    ]
                ],
                'cabinet' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'cabinet' => 'cabinet.php',
                    ]
                ],
                'shop' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'shop' => 'shop.php',
                    ]
                ]
            ],
        ],
    ],
];