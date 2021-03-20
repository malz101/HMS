<?php
class User extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function getUserAuth($id) {
        $this->db->query('SELECT * FROM login WHERE id = :id');

        //Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;

    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}