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

    const TYPE_FINGER = 0;  //指纹
    const TYPE_FACE = 1;    //面部识别
    const TYPE_CARD = 2;    //刷卡

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
            [['uid', 'type', 'date', 'created_at','status','did'], 'integer'],
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
            'did' => Yii::t('common', 'Did'),
            'status' => Yii::t('common', 'Status'),
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['uid' => 'uid']);
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['did' => 'did']);
    }

    public function getGoaway()
    {
        return $this->hasOne(GoAway::className(), ['aid' => 'aid']);
    }

    public function getTypes()
    {
        return [
            static::TYPE_FINGER => Yii::t('common', 'Finger'),
            static::TYPE_FACE => Yii::t('common', 'Face'),
            static::TYPE_CARD => Yii::t('common', 'Card'),
        ];
    }
}
