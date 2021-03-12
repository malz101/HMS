<?php
class MaintenancePersonnel {
    public function __construct(){
        parent::__construct();
    }

    public function add($data){
        $this->db->query('INSERT INTO mtnpersonnel (id_num, first_name, last_name, description)
                            VALUES (:id_num, :fname, :lanme, :description);');
        
        $this->db->bind(':id_num', $data['id_num']);
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':description', $data['description']);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }
    
    public function delete($id){
        $this->db->query('DELETE FROM mtnpersonnel WHERE id_num = :id_num');

        $this->db->bind(':id_num',$id);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function get($id){
        $this->db->query('SELECT * FROM mtnpersonnel WHERE id_num = :id_num');

        $this->db->bind(':id_num', $id);

        $mtnpersonnel = $this->db->single();

        return $mtnpersonnel;
    } #Completed function, returns a admin object when the admin is found in the database given the admin's id number


    // function __construct($full_name, $description){
    //     $this->full_name = $full_name;
    //     $this->description = $description;
    // }

    // public function getFullName(){
    //     return $this->full_name;
    // }

    // public function getDescription(){
    //     return $this->description;
    // }

    // public function getFullNameDescription(){
    //     $full_n_des = array($this->full_name, $this->description);
    //     return $full_n_des; #This should be imploded to access the values
    // }
}