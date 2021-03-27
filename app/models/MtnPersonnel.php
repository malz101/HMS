<?php
require_once 'User.php';
class MtnPersonnel extends User{

    public function __construct(){
        parent::__construct();
    }

    public function add($data){
        //query to insert into resident table
        $this->db->query('INSERT INTO mtnpersonnel (id_num, first_name, last_name, tele, email, affiliation) 
                            VALUES (:id_num, :fname, :lname, :tele, :email, :affiliation);');
        
        $this->db->bind(':id_num', $data['mid']);
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':tele', $data['tele']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':affiliation', $data['affiliation']);

        if ($this->db->execute()==false) {
            return false;
        }
        //query to update login info table
        $this->db->query('INSERT INTO login (id, password, type) VALUES (:id, :password,:type);');
        $this->db->bind(':id', $data['mid']);
        $this->db->bind(':password', hash('sha256',$data['password']));
        $this->db->bind(':type','mtnpersonnel');

        if ($this->db->execute()) {
            return true;
        }
        return false;
    } //Completed function, adds a resident to the database given the required parameters


    public function delete($id){
        $this->db->query('DELETE FROM mtnpersonnel WHERE id_num = :id_num');

        $this->db->bind(':id_num',$id);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function get($id_num){
        $this->db->query('SELECT * FROM mtn_personnel WHERE id_num = :id_num');

        $this->db->bind(':id_num', $id_num);

        $mtnpersonnel=$this->db->single();

        return $mtnpersonnel;
    } #Completed function, returns a resident object when the resident is found in the database given the resident's id number or FALSE if the resident is not found
} #completed class
