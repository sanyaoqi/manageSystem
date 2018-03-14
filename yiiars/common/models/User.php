<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $mobile
 * @property string $passwd_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property string $passwd write-only passwd
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public function attributeLabels()
    {
        return [
            'uid' => Yii::t('common', 'Uid'),
            'email' => Yii::t('common', 'Email'),
            'mobile' => Yii::t('common', 'Mobile'),
            'passwd' => Yii::t('common', 'Passwd'),
            'real_name' => Yii::t('common', 'Real Name'),
            'sex' => Yii::t('common', 'Sex'),
            'id_card' => Yii::t('common', 'Id Card'),
            'fingerprint' => Yii::t('common', 'Fingerprint'),
            'ic_card' => Yii::t('common', 'Ic Card'),
            'created_at' => Yii::t('common', 'Created At'),
            'role' => Yii::t('common', 'Role'),
            'auth_key' => Yii::t('common', 'Auth Key'),
            'password_reset_token' => Yii::t('common', 'Password Reset Token'),
            'access_token' => Yii::t('common', 'Access Token'),
            'status' => Yii::t('common', 'Status'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        // return '{{%user}}';
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    // public function behaviors()
    // {
    //     return [
    //         TimestampBehavior::className(),
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['passwd'], 'required'],
            [['fingerprint', 'created_at', 'role', 'status'], 'integer'],
            [['email', 'passwd', 'ic_card'], 'string', 'max' => 64],
            [['mobile'], 'string', 'max' => 11],
            [['real_name'], 'string', 'max' => 45],
            [['sex'], 'string', 'max' => 2],
            [['id_card'], 'string', 'max' => 30],
            [['auth_key', 'password_reset_token', 'access_token'], 'string', 'max' => 128],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['uid' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by mobile
     *
     * @param string $mobile
     * @return static|null
     */
    public static function findByMobile($mobile)
    {
        return static::findOne(['mobile' => $mobile, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByUsername($mobile)
    {
        return static::findByMobile($mobile);
    }

    /**
     * Finds user by passwd reset token
     *
     * @param string $token passwd reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::ispasswdResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if passwd reset token is valid
     *
     * @param string $token passwd reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates passwd
     *
     * @param string $passwd passwd to validate
     * @return bool if passwd provided is valid for current user
     */
    public function validatePassword($passwd)
    {
        return Yii::$app->security->validatePassword($passwd, $this->passwd);
    }

    /**
     * Generates passwd hash from passwd and sets it to the model
     *
     * @param string $passwd
     */
    public function setpasswd($passwd)
    {
        $this->passwd = Yii::$app->security->generatePasswordHash($passwd);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new passwd reset token
     */
    public function generatepasswdResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes passwd reset token
     */
    public function removepasswdResetToken()
    {
        $this->password_reset_token = null;
    }
}
