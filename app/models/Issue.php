<?php
require_once 'MtnPersonnel.php';
require_once 'Feedback.php';
require_once 'RepairScheduleSlot.php';

class Issue extends Model{
    private $issueID;
    private $date;
    private $HMemberIDnum;
    private $subject;
    private $classification;
    private $assigned_to;
    private $status;
    private $description;
    private $last_updated_by;
    private $updated_on;
    private $feedbacks;
    private $slots;

    public function __construct(){
        $NoOfArguments = func_num_args(); //return no of arguments passed in function
        $arguments = func_get_args();

        switch ($NoOfArguments) {
            case 0:
                $this->construct1();
                break;
            case 4:
                $this->construct2($arguments[0],$arguments[1], $arguments[2],$arguments[3]);
                break;
            default:
                echo "Invalid No of arguments passed";
                break;
        }
    }

    private function construct1(){
        parent::__construct();
    }

    private function construct2($rid,$subject,$classification,$description){
        parent::__construct();
        $date = date("Y-m-d"); #in format "Y-m-d ", ie: "2019-11-24"
        $this->date = $date;
        $this->HMemberIDnum = $rid;
        $this->subject = $subject;
        $this->classification = $classification;
        $this->description = $description;
    }

    public function getID(){
        return $this->issueID;
    }

    public function getOwnerID(){
        return $this->HMemberIDnum;
    }

    public function getSubject(){
        return $this->subject;
    }

    public function getClassification(){
        return $this->classification;
    }

    public function getAssigned(){
        return $this->assigned_to;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getDate(){
        return $this->date;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getLastUpdatedBy(){
        return $this->last_updated_by;
    }

    public function getUpdatedOn(){
        return $this->updated_on;
    }

    public function getFeedbacks(){
        return $this->feedbacks;
    }

    public function setFeedbacks($feedbacks){
        $this->feedbacks = $feedbacks;
    }

    public function getSlots(){
        return $this->slots;
    }

    public function setSlots($slots){
        $this->slots = $slots;
    }


    
/*==============================CLASS METHODS================================*/
    public static function add($issue): bool{
        $conn = new self::$db();
        $conn->query('INSERT INTO issues (HMemberIDnum,subject, classification, date, description) 
                            VALUES (:HMemberIDnum,:subject, :classification, :date, :description);');


        $conn->bind(':HMemberIDnum', $issue->getOwnerID());
        $conn->bind(':subject', $issue->getSubject());
        $conn->bind(':classification',$issue->getClassification());
        $conn->bind(':date', $issue->getDate());
        $conn->bind(':description', $issue->getDescription());

        if ($conn->execute()) {
            return true;
        }
        return false;
    }

    public static function getIssuesResByID($HMemberIDnum): array{
        $conn = new self::$db();
        $conn->query('SELECT * FROM issues WHERE HMemberIDnum = :HMemberIDnum ORDER BY date DESC;');
        $conn->bind(':HMemberIDnum', $HMemberIDnum);
        $issues = $conn->resultSet(__CLASS__);
        return $issues;
    } #returns an associative list of issues reported by a hall member using the hall member's ID number 


    public static function getIssuesMtnByID($id_num): array{
        $conn = new self::$db();
        $conn->query('SELECT * FROM issues WHERE assigned_to = :assigned_to ORDER BY date DESC;');
        $conn->bind(':assigned_to', $id_num);
        $issues = $conn->resultSet(__CLASS__);
        return $issues;
    } #returns an associative list of issues assinged to a mtn personnel using  ID number 

    public static function getIssueByResIDFilter($filter, $HMemberIDnum): array{
        $conn = new self::$db();
        $conn->query('SELECT * FROM issues 
                            WHERE HMemberIDnum = :HMemberIDnum and classification like :classification and status like :status
                            ORDER BY date DESC;');
        
        $conn->bind(':HMemberIDnum', $HMemberIDnum);
        $conn->bind(':classification', $filter['classification']);
        $conn->bind(':status', $filter['status']);
        $issues = $conn->resultSet(__CLASS__);
        return $issues;
    } #returns an associative list of issues reported by a hall member using the hall member's ID number 


    public static function getIssueByMtnIDFilter($filter, $id_num): array{
        $conn = new self::$db();
        $conn->query('SELECT * FROM issues 
                            WHERE assigned_to = :assigned_to and classification like :classification and status like :status
                            ORDER BY date DESC;');
        
        $conn->bind(':assigned_to', $id_num);
        $conn->bind(':classification', $filter['classification']);
        $conn->bind(':status', $filter['status']);
        $issues = $conn->resultSet(__CLASS__);
        return $issues;
    } #returns an associative list of issues reported by a hall member using the hall member's ID number 

    
    public static function updateIssue($data){
        $conn = new self::$db();
        $conn->query('UPDATE issues SET status = :status WHERE issueID = :issueID;');

        $conn->bind(':status', $data['status']);
        $conn->bind(':issueID', $data['iid']);

        if ($conn->execute()) {
            return true;
        }
        return false;
    }

    public static function getAllIssues(): array{
        $conn = new self::$db();
        $conn->query('SELECT * FROM issues ORDER BY date DESC;');

        $issues = $conn->resultSet(__CLASS__);

        return $issues;
    }//END viewAllIssues

    public static function getAllIssuesbyFilter($filter): array{
        $conn = new self::$db();
        $conn->query('SELECT * FROM issues where classification like :classification and status like :status
                        ORDER BY date DESC;');
        
        $conn->bind(':classification', $filter['classification']);
        $conn->bind(':status', $filter['status']);
        $issues = $conn->resultSet(__CLASS__);
        return $issues;
    }

    public static function getIssue($iid): Issue{
        $conn = new self::$db();
        $conn->query('SELECT * FROM issues WHERE issueID= :iid;');
        $conn->bind(':iid', $iid);
        $issue = $conn->single(__CLASS__);
        
        $feedbacks = Feedback::loadFeedbackFromIssue($issue->getID());
        $slots = RepairScheduleSlot::loadSlotForIssue($issue->getID());
        $issue->setFeedbacks($feedbacks);
        $issue->setSlots($slots);
        return $issue;
    }//END view Issue


    public static function addFeedback($data): bool{
        $conn = new self::$db();
        $conn->query('INSERT INTO feedback (issueID, comment, sender, date) 
                            VALUES (:issueID, :comment, :sender, :date);');
        $conn->bind(':issueID', $data['iid']);
        $conn->bind(':comment', $data['comment']);
        $conn->bind(':sender', $data['uid']);
        $date = date("Y-m-d"); #in format "Y-m-d ", ie: "2019-11-24 "
        $conn->bind(':date', $date);

        if ($conn->execute()) {
            return true;
        }else{
            return false;
        }
    }


    public static function searchForIssue($key): array{
        $conn = new self::$db();
        $conn->query('SELECT * FROM issues WHERE issueID like :key
                        ORDER BY date DESC;');
        
        $conn->bind(':key', $key);
        $issues = $conn->resultSet(__CLASS__);
        return $issues;
    }

    public static function searchForIssuebyResID($key, $HMemberIDnum): array{
        $conn = new self::$db();
        $conn->query('SELECT * FROM issues WHERE HMemberIDnum = :HMemberIDnum and issueID like :key
                        ORDER BY date DESC;');
        
        $conn->bind(':HMemberIDnum', $HMemberIDnum);
        $conn->bind(':key', $key);
        $issues = $conn->resultSet(__CLASS__);
        return $issues;
    }
    
    
    public static function searchForIssuebyMtnID($key, $id_num): array{
        $conn = new self::$db();
        $conn->query('SELECT * FROM issues WHERE assigned_to = :assigned_to and issueID like :key
                        ORDER BY date DESC;');
        
        $conn->bind(':assigned_to', $id_num);
        $conn->bind(':key', $key);
        $issues = $conn->resultSet(__CLASS__);
        return $issues;
    }
    


    public static function assignPersonnel($iid,$mid): bool{
        
        $conn = new self::$db();
        $conn->query('UPDATE issues SET assigned_to = :mtnpersonnel WHERE issueID = :issueID;');
       
        $conn->bind(':mtnpersonnel', $mid);
        $conn->bind(':issueID', intval($iid));

        if ($conn->execute()) {
            return true;
        }
        return false;
    }

} #class complete