<?php
require_once 'User.php';
require_once 'Resident.php';
require_once 'MtnPersonnel.php';

class Admin extends User{
    private $position;
    private $cluster_name;
    private $room_num;

    public function __construct(){
        parent::__construct();
    }

    public function getPosition(){
        return $this->position;
    }


/*========================CLASS METHODS=================================== */ 
    public static function get($id){
        $conn = new self::$db();
        $conn->query('SELECT * FROM admin WHERE id_num = :id_num');

        $conn->bind(':id_num', $id);

        $admin =$conn->single(__CLASS__);

        return $admin;
        
    } #Completed function, returns a admin object when the admin is found in the database given the admin's id number

    public static function getAllIssues(): array{
        $issues = Issue::getAllIssues();
        return $issues;
    }

    public static function getAllIssuesbyFilter($filter):array{
        $issues = Issue::getAllIssuesbyFilter($filter);
        return $issues;
    }

    public static function searchForIssue($key): array{
        $issue = Issue::searchForIssue($key);
        return $issue;
    }

    public static function updateIssue($data): bool{
        return Issue::updateIssue($data);
    }

    public static function addResident($data): bool{
        $resident = new Resident($data['rid'],$data['fname'],$data['lname'],$data['cluster'],
                                    $data['household'],$data['rnum']);
        return Resident::add($resident,$data['password']);
    }

    public static function addMtnPersonnel($data):bool{
        $mtn = new MtnPersonnel($data['mid'],$data['fname'],$data['lname'],
                                        $data['tele'],$data['email'],$data['affiliation']);
        return MtnPersonnel::add($mtn,$data['password']);
    }
}
