<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
<<<<<<< HEAD
        // $this->setUser();
=======
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
<<<<<<< HEAD

    protected function setUser()
    {
        $user = new User;
        $user->real_name = 'czhen';
        $user->setpasswd('111111');
        $user->mobile = '15010242231';
        $user->generateAuthKey();
        $user->role = 1;
        $user->created_at = time();
        $user->sex = 1;
        $user->password_reset_token = $user->auth_key;
        $user->status = User::STATUS_ACTIVE;
        $user->save();
        return $user;
    }
=======
>>>>>>> 6e2893a519f09d39667c33cb5062c708fa58566b
}
