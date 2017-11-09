<?php

namespace Models;

use Framework\Model;

class User extends Model
{

    protected $id;
    protected $login;
    protected $password;

//    protected $_observerClass = \Observers\User::class;


    public function getPassword() {
        var_dump(__LINE__, $this->password);
        die;
    }

    public function setPassword($value) {
        var_dump($value);
        die;
    }

}
