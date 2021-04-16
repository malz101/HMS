<?php
require_once 'User.php';
require_once 'Resident.php';
require_once 'MtnPersonnel.php';

class Admin extends User{
    private $position;
    private $cluster_name;
    private $room_num;

    public function __construct(){
        parent::__construct();
    }

    public function getPosition(){
        return $this->position;
    }


/*========================CLASS METHODS=================================== */ 
    public static function get($id){
        $conn = new self::$db();
        $conn->query('SELECT * FROM admin WHERE id_num = :id_num');

        $conn->bind(':id_num', $id);

        $admin =$conn->single(__CLASS__);

        return $admin;
        
    } #Completed function, returns a admin object when the admin is found in the database given the admin's id number

}
