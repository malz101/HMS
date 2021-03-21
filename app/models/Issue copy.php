<?php
class Issue extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function addIssue($data){
        $this->db->query('INSERT INTO issues (HMemberIDnum,subject, classification, date, description) 
                            VALUES (:HMemberIDnum,:subject, :classification, :date, :description);');


        $this->db->bind(':HMemberIDnum', $data['rid']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':classification', $data['classification']);
        $date = date("Y-m-d"); #in format "Y-m-d ", ie: "2019-11-24 "
        $this->db->bind(':date', $date);
        $this->db->bind(':description', $data['description']);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function viewIssuesByHallMemberID($HMemberIDnum){
        // $this->db->query('SELECT issueID, date, subject, classification,i.assigned_to, status, description 
        //                     FROM issues WHERE assigned_to=:unassigned AND HMemberIDnum = :HMemberIDnum;');
        // $this->db->bind(':HMemberIDnum', $HMemberIDnum);
        // $this->db->bind(':unassigned', 'Unassigned');
        // $issues_unassigned = $this->db->resultSet();


        $this->db->query('SELECT i.issueID, i.date, i.subject, i.classification, i.assigned_to, 
                                    i.status, i.description, mtn.first_name as mtnfname, 
                                    mtn.last_name as mtnlname 
                            FROM issues i left join mtnpersonnel mtn on i.assigned_to=mtn.id_num WHERE HMemberIDnum = :HMemberIDnum;');
        $this->db->bind(':HMemberIDnum', $HMemberIDnum);
        $issues_assigned = $this->db->resultSet();


        return $issues_assigned;
    } #returns an associative list of issues reported by a hall member using the hall member's ID number 

    public function updateIssue($data){
        $this->db->query('UPDATE issues SET status = :status WHERE issueID = :issueID;');

        $this->db->bind(':status', $data['status']);
        $this->db->bind(':issueID', $data['iid']);

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
        
        return $issues;
    }//END viewAllIssues

    public function viewIssue($iid){
        // $this->db->query('SELECT i.*, r.first_name as rfname, r.last_name as rlname,r.cluster_name, r.household, r.room_num
        //                     FROM issues i join resident r on i.HMemberIDnum=r.IDnum 
        //                     WHERE i.issueID= :iid;');
        // $this->db->bind(':iid', $iid);
        // $issue = $this->db->single();


        // $this->db->query('SELECT a.first_name as afname, a.last_name as alname 
        //                     FROM issues i join admin a on a.id_num= i.last_update_by
        //                     WHERE i.issueID= :iid;');
        // $this->db->bind(':iid', $iid);
        // $updatedby = $this->db->single();


        // $this->db->query('SELECT mtn.first_name as mtnfname, mtn.last_name as mtnlname 
        //                     FROM issues i join mtnpersonnel mtn on mtn.id_num= i.assinged_to
        //                     WHERE i.issueID= :iid;');
        // $this->db->bind(':iid', $iid);
        // $assignedto = $this->db->single();
                
        // return array_merge($issue, $updatedby, $assignedto);
    }//END view Issue
} #class complete