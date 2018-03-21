<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    // require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php'
    // require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
            'masterConfig' => [
                'username' => 'dba',
                'password' => '52Toys2015&*(', //'52Toys2015&*(',
                'attributes' => [
                    PDO::ATTR_TIMEOUT => 10
                ]
            ],
            'masters' => [
                [
                    'dsn' => "mysql:host=127.0.0.1;dbname=db_ars;",
                    'charset' => 'utf8',
                    'tablePrefix' => 'tbl_',
                ],
            ],
            'enableSchemaCache' => false,
            'schemaCacheDuration' => 3600,
            'schemaCache' => 'cache',
        ],
    ],
    'params' => $params,
];
