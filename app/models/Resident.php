<?php

class Resident extends User{

    public function __construct(){
        parent::__construct($IDnum);
    }

    public function add($data){
        $this->db->query('INSERT INTO resident (IDnum, first_name, last_name, cluster_name, household, room_num) 
                            VALUES (:IDnum, :fname, :lname, :cluster_name, :household, :room_num);');
        
        $this->db->bind(':IDnum', $data['IDnum']);
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':cluster_name', $data['cluster_name']);
        $this->db->bind(':household', $data['household']);
        $this->db->bind(':room_num', $data['room_num']);
        

        if ($this->db->execute()) {
            return true;
        }
        return false;
    } #Completed function, adds a resident to the database given the required parameters


    public function delete($id){
        $this->db->query('DELETE FROM resident WHERE IDnum = :id_num');

        $this->db->bind(':id_num',$id);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function get($IDnum){
        $this->db->query('SELECT * FROM resident WHERE IDnum = :IDnum');

        $this->db->bind(':IDnum', $IDnum);

        $resident=$this->db->single()

        // if($resident === []){
        //     echo "<script> alert('User not found');</script>";
        //     return FALSE;
        // } else {
        //     foreach($resident as $r){
        //         $this->resident = new Resident($r['IDnum'], $r['cluster_name'], $r['household'], $r['room_num']);
        //     }
        // }
        #echo '<p>This is the rest of the test</p>';
        #$this->resident = $statement->fetch();
        #echo $this->resident->getClusterName();
        return $resident;
    } #Completed function, returns a resident object when the resident is found in the database given the resident's id number or FALSE if the resident is not found


    // public function getClusterName(){
    //     return $this->cluster_name;
    // }

    // public function getRoomNum(){
    //     return $this->room_num;
    // }

    // public function getHousehold(){
    //     return $this->household;
    // }
} #completed class
