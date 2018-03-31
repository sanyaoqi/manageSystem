<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%go_away}}".
 *
 * @property int $gid
 * @property int $uid
 * @property int $type
 * @property int $date 签到日期
 * @property int $created_at 创建时间
 * @property int $did 设备ID
 * @property int $status 状态
 */
class GoAway extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%go_away}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'type', 'date'], 'required'],
            [['uid', 'type', 'date', 'created_at', 'did', 'status', 'aid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid' => Yii::t('common', 'Gid'),
            'uid' => Yii::t('common', 'Uid'),
            'type' => Yii::t('common', 'Type'),
            'date' => Yii::t('common', 'Date'),
            'created_at' => Yii::t('common', 'Go away datetime'),
            'did' => Yii::t('common', 'Did'),
            'status' => Yii::t('common', 'Status'),
            'aid' => Yii::t('common', 'Aid'), 
        ];
    }

    public function getAttendance()
    {
        return $this->hasOne(Attendance::className(), ['aid' => 'aid']);
    }
}
