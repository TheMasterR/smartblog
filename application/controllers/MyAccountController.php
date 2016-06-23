<?php

class myAccountController extends BaseController
{
    public function index()
    {
        $this->output['error']    = isset($this->params['error']) ? $this->params['error'] : null;

        // check to see if the user is logged in
        if(User::isLogged())
        {
            $this->output['templatePath'] = APP_PATH . 'templates/myAccount.php';
        } else {
            // else redirect him to login page
            redirect('/?page=auth&action=login');
        }
    }

    public function edit()
    {
        if (isPost() && User::isLogged()){
            $user = new User(User::getLogged()->id);
            $user->name = $this->params['name'];
            $user->motto = $this->params['motto'];
            $user->save();
            $user->saveProfilePicture();
            $user->saveCoverPicture();
            redirect('/?page=myAccount&succes=1');
        } else {
            redirect('/?page=myAccount&succes=0');
        }

    }

        # CHANGE PASSWORD
    public function chpwd()
    {
        $error = false;

        if (isPost())
        {
            if (!User::isLogged())
            {
                redirect('/?page=auth&action=login');
            } else {
                $this->output['templatePath'] = APP_PATH . 'templates/myAccount.php';
            }
            if (strlen($this->params['password']) === 0 && !$error)
            {
                $error = '<div style="color:red">Your current password is not corect.</div>';
            }
            if (strlen($this->params['newPassword']) < 4 && !$error)
            {
                $error = '<div style="color:red">Your new password has to be greater than 4 characters.</div>';
            }
            if ($this->params['newPassword'] !== $this->params['newPassword2'] && !$error)
            {
                $error = '<div style="color:red">Your new passwords do not match.</div>';
            }

            $user = new User(User::getLogged()->id);

            if ($user->password === md5($this->params['newPassword'] . User::PASSWORD_APPEND) && !$error)
            {
                $error = '<div style="color:red">Your new password is the same as yout old password.</div>';
            }

            if ($user->password === md5($this->params['password'] . User::PASSWORD_APPEND) && !$error)
            {
                $user->password = md5($this->params['newPassword'] . User::PASSWORD_APPEND);
                $user->save();
                $error = '<div style="color:green">Your password was successfully changed.</div>';
            }

            // set the error output
            $this->output['error'] = $error;
        }
    }
} // END OF CLASS
