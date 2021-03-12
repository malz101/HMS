<?php
class Residents extends Users {
    public function __construct() {
        $this->model = $this->model('Resident');
    }

    public function confirmation(){
        $this->view('/users/resident/log-issue.php');
    }

    public function addRedisdent(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'IDnum' => trim($_POST['IDnum']),
                'fname' => trim($_POST['fname']),
                'lname' => trim($_POST['lname']),
                'cluster_name' => trim($_POST['cluster_name']),
                'household' => trim($_POST['household']),
                'room_num' => trim($_POST['room_num']),
                'password' => trim($_POST['password'])
            ];

            //Validate id
            if (!empty($data['IDnum']) && !empty($data['password'])) {
                $this->model->add($data);
            }
    }
}