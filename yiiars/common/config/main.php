<?php
return [
    'aliases' => [
<<<<<<< HEAD
        '@bower' => '@vendor/bower',
=======
        '@bower' => '@vendor/bower-asset',
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
<<<<<<< HEAD
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
=======
            
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
        ],
    ],
];
