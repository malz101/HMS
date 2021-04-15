<?php
class Login extends Model{
    private $id;
    private $password;
    private $type;

    public function __construct(){
        $NoOfArguments = func_num_args(); //return no of arguments passed in function
        $arguments = func_get_args();

        switch ($NoOfArguments) {
            case 1:
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

    private function construct2($id,$password,$type){
        parent::__construct();
        $this->id = $id;
        $this->password = $password;
        $this->type = $type;
    }

    public function getUserID(){
        return $this->id;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getType(){
        return $this->type;
    }


/*================CLASS METHODS========================*/    
    public static function add($login): bool{
        $conn = new self::$db();
        
        //query to update login info table
        $conn->query('INSERT INTO login (id, password, type) VALUES (:id, :password,:type);');
        $conn->bind(':id', $login->getUserID());
        $conn->bind(':password', hash('sha256',$login->getPassword()));
        $conn->bind(':type',$login->getType());

        if ($conn->execute()) {
            return true;
        }
        return false;
    }

    //Find user by id. ID is passed in by the Controller.
    public static function get($id): Login {
        $conn = new self::$db();
        $conn->query('SELECT * FROM login WHERE id = :id');

        //Bind value
        $conn->bind(':id', $id);
        $login = $conn->single(__CLASS__);

        return $login;
    }
}