<?php

class Feedback extends Model {
    private $issueID;
    private $sender;
    private $comment;
    private $date;
    private $isRead;

    public function __construct(){
        $NoOfArguments = func_num_args(); //return no of arguments passed in function
        $arguments = func_get_args();

        switch ($NoOfArguments) {
            case 0:
                $this->construct1();
                break;
            case 3:
                $this->construct2($arguments[0],$arguments[1], $arguments[2]);
                break;
            default:
                echo "Invalid No of arguments passed";
                break;
        }
    }

    private function construct1(){
        parent::__construct();
    }

    private function construct2($issueID,$sender,$comment){
        parent::__construct();
        $date = date("Y-m-d"); #in format "Y-m-d ", ie: "2019-11-24 "
        $this->date = $date;
        $this->issueID = $issueID;
        $this->sender = $sender;
        $this->comment = $comment;
    }

    public function getID(){
        return $this->issueID;
    }

    public function getSender(){
        return $this->sender;
    }

    public function getComment(){
        return $this->comment;
    }

    public function getDate(){
        return $this->date;
    }

    public function getRead(){
        return $this->isRead;
    }


/*====================CLASS METHODS================================*/
    public static function add($feedback){
        $conn = new self::$db();
        $conn->query('INSERT INTO feedback (issueID, comment, sender, date) 
                            VALUES (:issueID, :comment, :sender, :date);');

        $conn->bind(':issueID', $feedback->getID());
        $conn->bind(':comment', $feedback->getComment());
        $conn->bind(':sender', $feedback->getSender());
        $conn->bind(':date', $feedback->getDate());

        if ($conn->execute()) {
            return true;
        }else{
            return false;
        }
    }

    public static function loadFeedbackFromIssue($issueID){
        $issueID = filter_var($issueID, FILTER_SANITIZE_NUMBER_INT);
        $conn = new self::$db();
        $conn->query('SELECT * FROM feedback WHERE issueID = :issueID');
        $conn->bind(':issueID', $issueID);

        $feedbacks = $conn->resultSet(__CLASS__);
        return $feedbacks;
    }

}