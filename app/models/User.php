<?php
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function login($id, $password) {
        $this->db->query('SELECT * FROM login WHERE id_num = :id');

        //Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (hash('sha256',$password)==$hashedPassword) {
            return $row;
        } else {
            return false;
        }
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