<?php
class Issue {
    private $db;

    public function __construct() {
        $this->db = new Database;
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


        // foreach($residents as $resident){
        //     echo $issues['date'] . " " . $issues['classification'] . " " . $issues['status'] . " " . $issues['description'] . " " . $issues[cluster_name] . " " . $issues['room_num'] . " " . $issues['household'];
        // }
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
        // foreach($issues as $issue){
        //     echo "<div class=\"hero-card\">";
        //     echo "<h3>Issue ID: ". $issue['issueID'] ."</h3>";
        //     echo "<h6>Date: ". $issue['date'] ."</h6>";
        //     echo "<h6>Hall Memeber ID number: ". $issue['HMemberIDnum'] ."</h6>";
        //     echo "<h6>Classification: ". $issue['classification'] ."</h6>";
        //     echo "<h6>Status: ". $issue['status'] ."</h6>";
        //     echo "<h6>Description: ". $issue['description'] ."</h6>";
        //     echo "<h6>Cluster name: ". $issue['cluster_name'] ."</h6>";
        //     echo "<h6>Room number: ". $issue['room_num'] ."</h6>";
        //     echo "<h6>Household: ". $issue['household'] ."</h6>";
        //     echo "</div>";
        // }
    }
} #class complete