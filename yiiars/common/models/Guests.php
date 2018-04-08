<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%guests}}".
 *
 * @property int $gid
 * @property int $created_at 拜访时间
 * @property int $uuid 百度识别的用户ID
 * @property string $image
 * @property int $status 状态，0未处理1已处理
 */
class Guests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%guests}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'uuid'], 'integer'],
            [['image'], 'string', 'max' => 1024],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid' => Yii::t('common', 'Gid'),
            'created_at' => Yii::t('common', 'Created At'),
            'uuid' => Yii::t('common', 'Uuid'),
            'image' => Yii::t('common', 'Image'),
            'status' => Yii::t('common', 'Status'),
        ];
    }

    public static function getTodayTotal()
    {
        $query = self::find();
        $time = strtotime(date('Y-m-d',time()));
        $query->where(['>=', 'created_at', $time]);
        return $query->count();
    }
}
