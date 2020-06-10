<p align="center">
    <h1 align="center">Shop for manufacture17.com.ua</h1>
    <br>
</p>

Based on Yii 2 Advanced Project Template.

Completed works
--------------

1. Application core refactoring
1. Build application db structure
1. Created enteties
1. Created forms (model)
1. Created manage services (for entities)
1. Created reposytories (for entities)
1. Created some helpers (for entities)
1. Some extensions installed
1. Registration
1. Authentification
1. Dashboard
1. Create controller for some entities
    - Ayth, Site, User, Brand, Category, Characteristic, Tag and Product Controller
1. Create views for backend (create, edit, delete)
    - Ayth, Site, User, Brand, Category, Characteristic, Tag

DEFAULT DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```

REFACTORING DIRECTORY STRUCTURE
-------------------

```
├── backend
│   ├── assets
│   ├── config
│   ├── controllers
│   │   └── shop
│   ├── forms
│   │   └── Shop
│   ├── runtime
│   ├── tests
│   │   ├── _data
│   │   ├── functional
│   │   ├── _output
│   │   ├── _support
│   │   └── unit
│   ├── views
│   │   ├── auth
│   │   ├── layouts
│   │   ├── shop
│   │   │   ├── brand
│   │   │   ├── category
│   │   │   ├── characteristic
│   │   │   ├── product
│   │   │   └── tag
│   │   ├── site
│   │   └── user
│   └── web
│       ├── assets
│       └── css
├── common
│   ├── bootstrap
│   ├── config
│   ├── fixtures
│   ├── generators
│   │   └── crud
│   │       └── default
│   │           └── views
│   ├── mail
│   │   ├── auth
│   │   │   ├── reset
│   │   │   └── signup
│   │   └── layouts
│   ├── runtime
│   ├── tests
│   │   ├── _data
│   │   ├── _output
│   │   └── _support
│   └── widgets
├── console
│   ├── config
│   ├── controllers
│   ├── migrations
│   ├── models
│   └── runtime
├── environments
│   ├── dev
│   │   ├── backend
│   │   │   ├── config
│   │   │   └── web
│   │   ├── common
│   │   │   └── config
│   │   ├── console
│   │   │   └── config
│   │   └── frontend
│   │       ├── config
│   │       └── web
│   └── prod
│       ├── backend
│       │   ├── config
│       │   └── web
│       ├── common
│       │   └── config
│       ├── console
│       │   └── config
│       └── frontend
│           ├── config
│           └── web
├── frontend
│   ├── assets
│   ├── config
│   ├── controllers
│   │   ├── auth
│   │   └── cabinet
│   ├── runtime
│   ├── tests
│   │   ├── acceptance
│   │   ├── _data
│   │   ├── functional
│   │   ├── _output
│   │   ├── _support
│   │   └── unit
│   │       └── models
│   ├── views
│   │   ├── auth
│   │   │   ├── auth
│   │   │   ├── reset
│   │   │   └── signup
│   │   ├── cabinet
│   │   │   └── default
│   │   ├── contact
│   │   ├── layouts
│   │   └── site
│   └── web
│       ├── assets
│       └── css
├── shop                   Contains core
│   ├── entities
│   │   ├── behaviors
│   │   ├── Shop
│   │   │   ├── Product
│   │   │   └── queries
│   │   └── User
│   ├── forms
│   │   ├── auth
│   │   └── manage
│   │       ├── Shop
│   │       │   └── Product
│   │       └── User
│   ├── helpers
│   ├── repositories
│   │   └── Shop
│   ├── services
│   │   ├── auth
│   │   └── manage
│   │       └── Shop
│   ├── tests
│   │   ├── _data
│   │   ├── _output
│   │   ├── _support
│   │   └── unit
│   │       ├── entities
│   │       │   ├── Shop
│   │       │   │   ├── Brand
│   │       │   │   ├── Category
│   │       │   │   ├── Characteristic
│   │       │   │   └── Tag
│   │       │   └── User
│   │       └── forms
│   └── validators
└── vagrant
    ├── config
    ├── nginx
    │   └── log
    └── provision

```

Used extensions:
----------------

1. dmstr/yii2-adminlte-asset
    - Best open source admin dashboard & control panel theme
0. webmozart/assert
    - Assertions to validate method input/output with nice error messages. 
0. la-haute-societe/yii2-save-relations-behavior
    - Validate and save automatically related Active Record models. 
0. yiisoft/yii2-authclient
    - AuthClient Extension for Yii 2
0. kartik-v/yii2-widgets
    - Collection of useful widgets for Yii Framework 2.0
0. kartik-v/yii2-field-range
    - xtension enables you to easily manage Yii 2 ActiveField ranges (e.g. from date / to date or from amount / to amount)
0. paulzi/yii2-nested-sets
    - Directory tree
0. yii-dream-team/yii2-upload-behavior
    - Behavior for uploding files
<!-- 0. bower-asset/font-awesome
0. bower-asset/owl.carousel
0. bower-asset/magnific-popup
0. elasticsearch/elasticsearch
0. yii-cms/yii2-robokassa
0. phpoffice/phpexcel
0. mihaildev/yii2-ckeditor
0. mihaildev/yii2-elfinder
0. fishvision/yii2-migrate
0. guzzlehttp/guzzle
0. filsh/yii2-oauth2-server
0. flow/jsonpath
0. drewm/mailchimp-api
0. yiisoft/yii2-redis
0. zhuravljov/yii2-queue
0. league/flysystem -->


<!-- 
Для ссылок 

[пример][1] [нескольких][2] [ссылок][id]

[1]: http://example.com/ "Optional Title Here"
[2]: http://example.com/some
[id]: http://example.com/links (Optional Title Here) -->