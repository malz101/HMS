<?php
require_once 'User.php';
require_once 'Feedback.php';

class Resident extends User{
    private $cluster_name;
    private $household;
    private $room_num;
    //private $issues;

    public function __construct(){
        $NoOfArguments = func_num_args(); //return no of arguments passed in function
        $arguments = func_get_args();

        switch ($NoOfArguments) {
            case 0:
                $this->construct1();
                break;
            case 6:
                $this->construct2($arguments[0],$arguments[1], $arguments[2],$arguments[3],
                                    $arguments[4],$arguments[5]);
                break;
            default:
                echo "Invalid No of arguments passed";
                break;
        }
    }

    private function construct1(){
        parent::__construct();
    }

    private function construct2($id_num,$first_name,$last_name,$cluster_name,$household,$room_num){
        parent::__construct();
        $this->id_num = $id_num;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->cluster_name = $cluster_name;
        $this->household = $household;
        $this->room_num = $room_num;
    }

    public function getClusterName(){
        return $this->cluster_name;
    }

    public function getHousehold(){
        return $this->household;
    }
    
    public function getRoomNum(){
        return $this->room_num;
    }

    // public function getIssues(){
    //     return $this->issues;
    // }

    // public function setIssues($issues){
    //     $this->issues = $issues; 
    // }



/*================================CLASS FUNCTIONS========================================*/
    public static function add($resident,$password): bool{
        $conn = new self::$db();
        //query to insert into resident table
        $conn->query('INSERT INTO resident (id_num, first_name, last_name, cluster_name, household, room_num) 
                            VALUES (:id_num, :fname, :lname, :cluster_name, :household, :room_num);');
        
        $conn->bind(':id_num', $resident->getID());
        $conn->bind(':fname', $resident->getFirstName());
        $conn->bind(':lname', $resident->getLastName());
        $conn->bind(':cluster_name', $resident->getClusterName());
        $conn->bind(':household', $resident->getHousehold());
        $conn->bind(':room_num', $resident->getRoomNum());

        if ($conn->execute()==false) {
            return false;
        }

        //query to update login info table
        $login = new Login($resident->getID(),$password,'resident');

        if (Login::add($login)) {
            return true;
        }
        return false;
    } //Completed function, adds a resident to the database given the required parameters


    public static function delete($id): bool{
        $conn = new self::$db();
        $conn->query('DELETE FROM resident WHERE id_num = :id_num');

        $conn->bind(':id_num',$id);

        if ($conn->execute()) {
            return true;
        }
        return false;
    }

    public static function get($id_num): Resident{
        $conn = new self::$db();
        $conn->query('SELECT * FROM resident WHERE id_num = :id_num');

        $conn->bind(':id_num', $id_num);

        $resident=$conn->single(__CLASS__);
        return $resident;
    } #Completed function, returns a resident object when the resident is found in the database given the resident's id number or FALSE if the resident is not found


    public static function addIssue($data): bool{
        $issue = new Issue($data['rid'],$data['subject'], $data['classification'], $data['description']);
        return Issue::add($issue);
    } 


    public static function addFeedback($data): bool{
        $feedback = new Feedback($data['iid'], $data['uid'],$data['comment']);
        return Feedback::add($feedback);
    }

} #completed class
