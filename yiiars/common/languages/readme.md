
1. 使用gii生成模型文件，注意：勾选i18n选项，并设置分类名（如：common）。 
2. 生成配置 common_i18n.php
    配置文件中设置待提取的源文件目录和生成国际化文件的目标目录等
    如：
    [
        'sourcePath' => __DIR__ . DIRECTORY_SEPARATOR . '../../common',
        'languages' => ['zh-CN'],
        ...
        'messagePath' =>  __DIR__ . DIRECTORY_SEPARATOR . '../languages',
    ]
2. 然后进入项目目录yiiars下
    cd  yiiars/
    ./yii message/extract @common/config/common_i18n.php
    注意：@common替换为实际配置存放路径
3. 检查文件生成结果。
    cd @common/languages
    vim ./zh-CN/backend.php
5. 修改应用配置文件。加入i18n组件配置。
    'components' => [
        ...
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
    ]
