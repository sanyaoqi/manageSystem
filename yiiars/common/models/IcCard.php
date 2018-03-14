<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ic_card}}".
 *
 * @property int $cid
 * @property string $code 卡号
 * @property int $status 状态
 * @property int $uid 绑定的用户
 * @property string $money
 * @property int $created_at 生成日期
 * @property int $end_time 过期时间
 */
class IcCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ic_card}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['status', 'uid', 'created_at', 'end_time'], 'integer'],
            [['money'], 'number'],
            [['code'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => Yii::t('common', 'Cid'),
            'code' => Yii::t('common', 'Code'),
            'status' => Yii::t('common', 'Status'),
            'uid' => Yii::t('common', 'Uid'),
            'money' => Yii::t('common', 'Money'),
            'created_at' => Yii::t('common', 'Created At'),
            'end_time' => Yii::t('common', 'End Time'),
        ];
    }
}
