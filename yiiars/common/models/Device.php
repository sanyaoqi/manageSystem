<?php

namespace common\models;

use Yii;
use yii\base\Exception;

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
            [[ 'status', 'created_at'], 'integer'],
            [['info', 'config', 'name'], 'string'],
            [['position', 'name'], 'string', 'max' => 45],
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

    /**
     * [callCurl description]
     * @param  [type] $url    [description]
     * @param  [type] $params [description]
     * @param  string $method [description]
     * @return [type]         [description]
     */
    public static function callCurl($url, $params, $method='GET')
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $res = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new Exception(curl_error($curl), 0);
        } else {
            $httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode) {
                throw new Exception($res, $httpStatusCode);
            }
        }
        curl_close($curl);
        return $res;
    }
}
