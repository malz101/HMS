<?php
class Issue extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function addIssue($data){
        $this->db->query('INSERT INTO issues (HMemberIDnum, classification, date, description) 
                            VALUES (:HMemberIDnum, :classification, :date, :description);');


        $this->db->bind(':HMemberIDnum', $data['HMemberIDnum']);
        $this->db->bind(':classification', $data['classification']);
        $date = date("m d Y"); #in format "m d Y", ie: "11 24 2019"
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':description', $data['description']);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function viewIssuesByHallMemberID($HMemberIDnum){
        $this->db->query('SELECT issueID, date, classification, status, description 
                            FROM issues WHERE HMemberIDnum = :HMemberIDnum');

        $this->db->bind(':HMemberIDnum', $HMemberIDnum);
        
        $issues = $this->db->resultSet();
        return $issues;
    } #returns an associative list of issues reported by a hall member using the hall member's ID number 

    public function updateIssue($issueID, $status){
        $this->db->query('UPDATE issues SET status = :status WHERE issueID = :issueID;');

        $this->db->bind(':status', $status);
        $this->db->bind(':issueID', $issueID);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function viewIssuesByCluster($cluster_name){
        
    }

    public function viewIssuesByStatus($status){

    }

    public function viewIssuesByStatusANDHallMemberID($status, $HMemberIDnum){

    }

    public function viewIssuesByClassification($classification){

    }

    public function viewAllIssues(){
        $this->db->query('SELECT * FROM issues;');

        $issues = $this->db->resultSet();
        
        return issues;
    }
} #class complete