<?php

class AuthController extends BaseController
{
    // define the login functionality
    public function login()
    {
        $this->output['register'] = isset($this->params['register']) ? $this->params['register'] : null;
        $this->output['error']    = isset($this->params['error']) ? $this->params['error'] : null;
        $this->output['templatePath'] = APP_PATH . 'templates/login.php';
        $this->output['login'] = true;
    }

    public function doLogin()
    {
        if (isPost())
        {
            $user = new User();
            $user->read('email', $this->params['email']);
            $expectedPassword = md5($this->params['password'] . User::PASSWORD_APPEND);

            if ($user->password === $expectedPassword)
            {
                // fa login
                $user->login();

                if (isset($this->params['aid']))
                {
                    redirect('/index.php?page=article&id='.$this->params['aid']);
                } else {
                    redirect('/index.php');
                }
            } else
            {
                redirect('/index.php?page=auth&action=login');
            }
        } else
        { // if its not post
            redirect('/index.php?page=auth&action=login');
        }
    }

    public function doLogout()
    {
        User::logout();
        redirect('/index.php');
    }


    // REGISTER
    public function register()
    {
        $error = false;

        if (isPost())
        {
            if (empty($this->params['name']))
            {
                $error = 'Insert name!';
            } elseif (filter_var($this->params['email'], FILTER_VALIDATE_EMAIL) === false)
            {
                $error = 'Insert a valid email';
            } elseif (User::emailExists($this->params['email']))
            {
                $error = 'Email exists!';
            } elseif (strlen($this->params['password']) < 4)
            {
                $error = 'Password needs to be higher than 4 characters!';
            } elseif ($this->params['password'] !== $this->params['password2'])
            {
                $error = 'The two passwords entered, are not identical!';
            }

            // if no error, insert the user
            if (!$error)
            {
                $user           = new User();
                $user->name     = $this->params['name'];
                $user->email    = $this->params['email'];
                $user->password = md5($this->params['password'] . User::PASSWORD_APPEND);
                $user->type     = 'user';
                $user->motto    = 'Change your motto from MyAccount';
                $user->save();
                redirect('/index.php?page=auth&action=login');
            }
            $this->output['post'] = $this->params;
        }

        $this->output['registerError'] = $error;
        $this->output['templatePath']  = APP_PATH . 'templates/register.php';
        $this->output['register']      = true;
    }
} // END OF CLASS
