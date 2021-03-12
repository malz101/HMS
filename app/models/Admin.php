<?php

class Admin extends User{
    public function __construct(){
        parent::__construct();
    }

    public function add($data){
        $this->db->query('INSERT INTO admin (id_num, first_name, last_name, position)
                            VALUES (:id_num, :fname, :lname, :position);');
        
        $this->db->bind(':id_num', $data['id_num']);
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':position', $data['position']);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }
    
    public function delete($id){
        $this->db->query('DELETE FROM admin WHERE id_num = :id_num');

        $this->db->bind(':id_num',$id);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function get($id){
        $this->db->query('SELECT * FROM admin WHERE id_num = :id_num');

        $this->db->bind(':id_num', $id);

        $admin = $this->db->single();

        return $admin;
        /*foreach($admin as $a){
            $this->admin = new Admin($a['id_num'], $a['cluster_name'], $a['room_num'], $a['position'], $a['full_name']);
        }*/

        // if($admin === []){
        //     echo "<script> alert('User not found');</script>";
        //     return FALSE;
        // } else {
        //     foreach($admin as $a){
        //         $this->admin = new Admin($a['id_num'], $a['cluster_name'], $a['room_num'], $a['position'], $a['full_name']);
        //     }
        // }
        // return $this->admin;
    } #Completed function, returns a admin object when the admin is found in the database given the admin's id number

}
