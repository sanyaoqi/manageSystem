<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%attendance}}".
 *
 * @property int $aid
 * @property int $uid
 * @property int $type
 * @property int $date 签到日期
 * @property int $created_at 创建时间
 */
class Attendance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attendance}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'type', 'date'], 'required'],
            [['uid', 'type', 'date', 'created_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aid' => Yii::t('common', 'Aid'),
            'uid' => Yii::t('common', 'Uid'),
            'type' => Yii::t('common', 'Type'),
            'date' => Yii::t('common', 'Date'),
            'created_at' => Yii::t('common', 'Created At'),
        ];
    }
}
