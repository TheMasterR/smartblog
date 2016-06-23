<?php

class User extends BaseObject
{
    protected static $TABLE_NAME = 'users';
    // declaram FIELDS pentru functia get / save din baseobject
    protected static $FIELDS = array(
        'id', 'name', 'email', 'password', 'type', 'motto'
    );

    public $id, $name, $password, $email, $type;

    // salt hash for password
    const PASSWORD_APPEND = 'djsfsoaijd1243234$#@#^&';

    public static function emailExists($email)
    {
        $q = self::getDBConnection();
        $emailEscaped = $q->realEscape($email);

        return !!(count(self::getAll("WHERE email = '{$emailEscaped}'")));
    }

    public function login()
    {
        $_SESSION['loggedUserId'] = $this->id;
    }

    public function logout()
    {
        unset($_SESSION['loggedUserId']);
    }

    public static function isLogged()
    {
        return isset($_SESSION['loggedUserId']) && !empty($_SESSION['loggedUserId']);
    }

    public static function getLogged()
    {
        if (!User::isLogged())
        {
            return false;
        }

        static $user = null;

        if (is_null($user))
        {
            $user = new User($_SESSION['loggedUserId']);
        }

        return $user;
    }

    public function saveProfilePicture()
    {
        $uploadImage = 'public/uploads/profile/' . $this->id;
        if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadImage))
        {
            return true;
        }
        return false;
    }

    public function saveCoverPicture()
    {
        $uploadImage = 'public/uploads/cover/' . $this->id;
        if (move_uploaded_file($_FILES['coverPicture']['tmp_name'], $uploadImage))
        {
            return true;
        }
        return false;
    }

} // END OF CLASS
