<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%device}}".
 *
 * @property int $did
 * @property int $name 签到日期
 * @property string $position
 * @property int $status
 * @property int $created_at 创建时间
 * @property string $info
 * @property string $data_dir
 * @property string $config
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%device}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'status', 'created_at'], 'integer'],
            [['info', 'config'], 'string'],
            [['position'], 'string', 'max' => 45],
            [['data_dir'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'did' => Yii::t('common', 'Did'),
            'name' => Yii::t('common', 'Name'),
            'position' => Yii::t('common', 'Position'),
            'status' => Yii::t('common', 'Status'),
            'created_at' => Yii::t('common', 'Created At'),
            'info' => Yii::t('common', 'Info'),
            'data_dir' => Yii::t('common', 'Data Dir'),
            'config' => Yii::t('common', 'Config'),
        ];
    }
}
