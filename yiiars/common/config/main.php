<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
            'masterConfig' => [
                'username' => 'root',
                'password' => 'root', //'52Toys2015&*(',
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
        'i18n' => [
            'translations' => [
                'common' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/languages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'common' => 'common.php',
                    ],
                ],
            ],
        ],
        'formatter' => [
            'dateFormat' => 'yyyy-MM-dd',
            'timeFormat' => 'HH:mm:ss',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss'
        ]
    ],
];
