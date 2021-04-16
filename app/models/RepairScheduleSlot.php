<?php

class RepairScheduleSlot extends Model {
    private $issueID;
    private $mtnID;
    private $dat;

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

    private function construct2($issueID,$mtnID,$date){
        parent::__construct();
        
        $this->date = $date;
        $this->issueID = $issueID;
        $this->mtnID = $mtnID;
    }

    public function getIssueID(){
        return $this->issueID;
    }

    public function getMtnID(){
        return $this->mtnID;
    }

    public function getDateTime(){
        return $this->date;
    }


/*====================CLASS METHODS================================*/
    public static function book($slot){
        $conn = new self::$db();
        $conn->query('INSERT INTO repair_schedule (issueID, mtnID, date) 
                            VALUES (:issueID, :mtnID, :date);');

        $conn->bind(':issueID', $slot->getIssueID());
        $conn->bind(':mtnID', $slot->getMtnID());
        $conn->bind(':date', $slot->getDateTime());
        try {
            if ($conn->execute()) {
                return true;
            }else{
                return false;
            }
        } catch (Exception $e) {
            return false;
        }

    }

    public static function loadSlotForIssue($issueID){
        $issueID = filter_var($issueID, FILTER_SANITIZE_NUMBER_INT);
        $conn = new self::$db();
        $conn->query('SELECT * FROM repair_schedule WHERE issueID = :issueID');
        $conn->bind(':issueID', $issueID);

        $slots = $conn->resultSet(__CLASS__);
        return $slots;
    }


    public static function loadSlotForMtn($mtnID){
        $mtnID = filter_var($mtnID, FILTER_SANITIZE_NUMBER_INT);
        $conn = new self::$db();
        $conn->query('SELECT * FROM repair_schedule WHERE mtnID = :mtnID');
        $conn->bind(':mtnID', $mtnID);

        $slots = $conn->resultSet(__CLASS__);
        return $slots;
    }

}