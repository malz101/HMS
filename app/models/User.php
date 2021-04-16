<?php
require_once 'Login.php';
require_once 'Issue.php';
class User extends Model{
    protected $id_num;
    protected $first_name;
    protected $last_name;
    //protected $login;

    public function __construct(){
        parent::__construct();
    }

    public function getID(){
        return $this->id_num;
    }

    public function getFirstName(){
        return $this->first_name;
    }

    public function getLastName(){
        return $this->last_name;
    }


/*================CLASS METHODS=====================*/
    public static function getUserAuth($id) {

        $login = Login::get($id);

        return $login;
    }

}