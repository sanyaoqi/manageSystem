<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ic_log}}".
 *
 * @property int $id
 * @property int $created_at
 * @property int $event 事件
 * @property int $uid
 * @property string $money
 * @property string $flash 快照
 * @property int $cid
 */
class IcLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ic_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'event', 'uid'], 'required'],
            [['created_at', 'event', 'uid', 'cid'], 'integer'],
            [['money'], 'number'],
            [['flash'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'created_at' => Yii::t('common', 'Created At'),
            'event' => Yii::t('common', 'Event'),
            'uid' => Yii::t('common', 'Uid'),
            'money' => Yii::t('common', 'Money'),
            'flash' => Yii::t('common', 'Flash'),
            'cid' => Yii::t('common', 'Cid'),
        ];
    }
}
