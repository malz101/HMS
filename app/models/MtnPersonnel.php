<?php
require_once 'User.php';
class MtnPersonnel extends User{
    private $tele;
    private $email;
    private $affiliation;
    private $skills_desc;

    public function __construct(){
        $NoOfArguments = func_num_args(); //return no of arguments passed in function
        $arguments = func_get_args();

        switch ($NoOfArguments) {
            case 0:
                $this->construct1();
                break;
            case 7:
                $this->construct2($arguments[0],$arguments[1], $arguments[2],$arguments[3],
                                    $arguments[4],$arguments[5], $arguments[6]);
                break;
            default:
                echo "Invalid No of arguments passed";
                break;
        }
    }

    private function construct1(){
        parent::__construct();
    }

    private function construct2($mid,$fname,$lname,$tele,$email,$affiliation,$skills_desc){
        parent::__construct();
        $this->id_num = $mid;
        $this->first_name = $fname;
        $this->last_name = $lname;
        $this->tele = $tele;
        $this->email = $email;
        $this->affiliation = $affiliation;
        $this->skills_desc = $skills_desc;  
    }

    public function getTele(){
        return $this->tele;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getAffliation(){
        return $this->affiliation;
    }

    public function getSkillsDesc(){
        return $this->skills_desc;
    }


/*=================CLASS METHODS===================*/
    public static function add($mtnpersonnel,$password): bool{
        $conn = new self::$db();
        //query to insert into resident table
        $conn->query('INSERT INTO mtnpersonnel (id_num, first_name, last_name, tele, email, affiliation, skills_desc) 
                            VALUES (:id_num, :fname, :lname, :tele, :email, :affiliation, :skills_desc);');
        
        $conn->bind(':id_num', $mtnpersonnel->getID());
        $conn->bind(':fname', $mtnpersonnel->getFirstName());
        $conn->bind(':lname', $mtnpersonnel->getLastName());
        $conn->bind(':tele', $mtnpersonnel->getTele());
        $conn->bind(':email', $mtnpersonnel->getEmail());
        $conn->bind(':affiliation', $mtnpersonnel->getAffliation());
        $conn->bind(':skills_desc', $mtnpersonnel->getSkillsDesc());

        try{
            if ($conn->execute()==false) {
                return false;
            }
        }catch(Exception $e){
            return false;
        }

        
        //query to update login info table
        $login = new Login($mtnpersonnel->getID(),$password,'mtnpersonnel');

        if (Login::add($login)) {
            return true;
        }
        return false;
    } //Completed function, adds a resident to the database given the required parameters


    public static function delete($id){
        $conn = new self::$db();
        $conn->query('DELETE FROM mtnpersonnel WHERE id_num = :id_num');

        $conn->bind(':id_num',$id);

        if ($conn->execute()) {
            return true;
        }
        return false;
    }

    public static function get($id_num): MtnPersonnel{
        $conn = new self::$db();
        $conn->query('SELECT * FROM mtnpersonnel WHERE id_num = :id_num');

        $conn->bind(':id_num', $id_num);

        $mtnpersonnel = $conn->single(__CLASS__);
        if ($mtnpersonnel==false){
            $mtnpersonnel = new MtnPersonnel();
        }
        return $mtnpersonnel;
    } #Completed function, returns a resident object when the resident is found in the database given the resident's id number or FALSE if the resident is not found

    public static function getAll(): array{
        $conn = new self::$db();
        $conn->query('SELECT * FROM mtnpersonnel');

        $mtnpersonnel = $conn->resultSet(__CLASS__);

        return $mtnpersonnel;
    } #Completed function, returns a resident object when the resident is found in the database given the resident's id number or FALSE if the resident is not found

} #completed class
