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
<<<<<<< HEAD
 * @property string $mobile
 * @property string $passwd_hash
=======
 * @property string $username
 * @property string $password_hash
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
<<<<<<< HEAD
 * @property string $passwd write-only passwd
=======
 * @property integer $updated_at
 * @property string $password write-only password
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
<<<<<<< HEAD
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
=======
    const STATUS_ACTIVE = 10;

>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
<<<<<<< HEAD
        // return '{{%user}}';
=======
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    // public function behaviors()
    // {
    //     return [
    //         TimestampBehavior::className(),
    //     ];
    // }
=======
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
<<<<<<< HEAD
            [['passwd'], 'required'],
            [['fingerprint', 'created_at', 'role', 'status'], 'integer'],
            [['email', 'passwd', 'ic_card'], 'string', 'max' => 64],
            [['mobile'], 'string', 'max' => 11],
            [['real_name'], 'string', 'max' => 45],
            [['sex'], 'string', 'max' => 2],
            [['id_card'], 'string', 'max' => 30],
            [['auth_key', 'password_reset_token', 'access_token'], 'string', 'max' => 128],
=======
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
<<<<<<< HEAD
        return static::findOne(['uid' => $id, 'status' => self::STATUS_ACTIVE]);
=======
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
<<<<<<< HEAD
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
=======
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
<<<<<<< HEAD
        if (!static::ispasswdResetTokenValid($token)) {
=======
        if (!static::isPasswordResetTokenValid($token)) {
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
<<<<<<< HEAD
     * Finds out if passwd reset token is valid
     *
     * @param string $token passwd reset token
=======
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
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
<<<<<<< HEAD
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
=======
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
<<<<<<< HEAD
     * Generates new passwd reset token
     */
    public function generatepasswdResetToken()
=======
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
<<<<<<< HEAD
     * Removes passwd reset token
     */
    public function removepasswdResetToken()
=======
     * Removes password reset token
     */
    public function removePasswordResetToken()
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
    {
        $this->password_reset_token = null;
    }
}
