<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{

    public $username;
    public $password;
    public $verifyCode;
    public $rememberMe;
    public $verifyCode;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
<<<<<<< .mine
            // username and password are required
            array('username, password,verifyCode', 'required'),
            array('verifyCode', 'captcha', 'on' => 'login', 'allowEmpty' => !CCaptcha::checkRequirements()),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
=======
            // username and password are required
                  array( 'username, password,verifyCode' , 'required' ) ,
//            array('username', 'required', 'message' => '登录帐号不能为空'),
//            array('password', 'required', 'message' => '密码不能为空'),
//            array('verifyCode', 'required', 'message' => '验证码不能为空'),
            array('verifyCode', 'captcha', 'on' => 'login', 'allowEmpty' => !Yii::app()->admin->isGuest),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
>>>>>>> .r70
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
<<<<<<< .mine
            'rememberMe' => 'Remember me next time',
            'username' => '用户名',
            'password' => '密码',
            'verifyCode' => '验证码',
=======
            'rememberMe' => 'Remember me next time',
            'username' => '用户名',
            'password' => '密码',
            'verifyCode' => '验证码'
>>>>>>> .r70
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $this->_identity = new UserIdentity($this->username, $this->password);
            if (!$this->_identity->authenticate())
                $this->addError('password', '用户名或密码不正确');
        }
    }

<<<<<<< .mine
    public function validateVerifyCode($verifyCode)
    {
        if (strtolower($this->verifyCode) === strtolower($verifyCode))
        {
            return true;
        }
        else
        {
            $this->addError('verifyCode', '验证码错误');
        }
    }

=======
    public function validateVerifyCode($verifyCode)
    {
        if (strtolower($this->verifyCode) === strtolower($verifyCode))
        {
            return true;
        }
        else
        {
            $this->addError('verifyCode', '验证码错误.');
        }
    }

>>>>>>> .r70
    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null)
        {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
        {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        }
        else
            return false;
    }

}
