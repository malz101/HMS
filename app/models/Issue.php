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

        $this->db->query('SELECT i.issueID, i.date, i.subject, i.classification, i.assigned_to, 
                                    i.status, i.description, mtn.first_name as mtnfname, 
                                    mtn.last_name as mtnlname 
                            FROM issues i left join mtnpersonnel mtn on i.assigned_to=mtn.id_num WHERE HMemberIDnum = :HMemberIDnum;');
        $this->db->bind(':HMemberIDnum', $HMemberIDnum);
        $issues = $this->db->resultSet();


        return $issues;
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

    public function viewAllIssues(){
        $this->db->query('SELECT i.issueID, i.date, i.subject, i.classification, i.assigned_to, 
                                    i.status, i.description, mtn.first_name as mtnfname, 
                                    mtn.last_name as mtnlname 
                            FROM issues i left join mtnpersonnel mtn on i.assigned_to=mtn.id_num;');

        $issues = $this->db->resultSet();

        return $issues;
    }//END viewAllIssues

    public function viewAllIssuesbyFilter($filter){
        $this->db->query('SELECT i.issueID, i.date, i.subject, i.classification, i.assigned_to, 
                                    i.status, i.description, mtn.first_name as mtnfname, 
                                    mtn.last_name as mtnlname 
                            FROM issues i left join mtnpersonnel mtn on i.assigned_to=mtn.id_num 
                            where i.classification like :classification and i.status like :status;');
        
        $this->db->bind(':classification', $filter['classification']);
        $this->db->bind(':status', $filter['status']);
        $issues = $this->db->resultSet();
        return $issues;
    }

    public function viewIssue($iid){
        $this->db->query('SELECT i.*, r.first_name as rfname, r.last_name as rlname,r.cluster_name, r.household, r.room_num,
                                    mtn.first_name as mtnfname, mtn.last_name as mtnlname, a.first_name as afname, 
                                    a.last_name as alname
                            FROM issues i join resident r on i.HMemberIDnum=r.IDnum 
                            left join admin a on a.id_num= i.last_updated_by
                            left join mtnpersonnel mtn on i.assigned_to=mtn.id_num
                            WHERE i.issueID= :iid;');
        $this->db->bind(':iid', $iid);
        $issue = $this->db->single();
        return $issue;
    }//END view Issue


    public function addFeedback($data){
        $this->db->query('INSERT INTO feedback (issueID, comment, sender, date) 
                            VALUES (:issueID, :comment, :sender, :date);');
        $this->db->bind(':issueID', $data['iid']);
        $this->db->bind(':comment', $data['comment']);
        $this->db->bind(':sender', $data['uid']);
        $date = date("Y-m-d"); #in format "Y-m-d ", ie: "2019-11-24 "
        $this->db->bind(':date', $date);

        if ($this->db->execute()) {
            return true;
        }else{
            return false;
        }
    }

    public function getIssueFeedbacks($issueID){
        $this->db->query('SELECT date, comment, isRead FROM feedback WHERE issueID = :issueID;');
        
        $this->db->bind(':issueID', $issueID);
        $feedbacks = $this->db->resultSet();

        return $feedbacks;
    }


    public function searchForIssue($key){
        $this->db->query('SELECT i.issueID, i.date, i.subject, i.classification, i.assigned_to, 
                                    i.status, i.description, mtn.first_name as mtnfname, 
                                    mtn.last_name as mtnlname 
                            FROM issues i left join mtnpersonnel mtn on i.assigned_to=mtn.id_num 
                            where i.issueID like :key;');
        
        $this->db->bind(':key', $key);
        $issues = $this->db->resultSet();
        return $issues;
    }

} #class complete