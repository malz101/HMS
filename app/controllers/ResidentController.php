<?php
require_once 'UserController.php';
class ResidentController extends UserController {
    public function __construct() {
        $this->residentModel = $this->model('Resident');
    }

    public function confirmation(){
        $data=array();
        $this->view('/users/resident/confirmation',$data);
    }

    public function home(){
        $data=array('title' => 'Resident Home Page');
        $this->view('/users/resident/resident',$data);
    }

    public function addResident(){
        $data = array(
            'title' => 'Add Resident Page',
            'rid' => '',
            'fname' => '',
            'lname' => '',
            'cluster' => '',
            'household' => '',
            'rnum' => '',
            'message' => '',
            'idError' => '',
            'householdError' => '',
            'roomNumberError' => '',
            'addUserError' => ''
        );


        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data['rid'] = trim($_POST['rid']);
            $data['fname'] = trim($_POST['fname']);
            $data['lname'] = trim($_POST['lname']);
            $data['cluster'] = trim($_POST['cluster']);
            $data['household'] = trim($_POST['household']);
            $data['rnum']= trim($_POST['rnum']);
            $data['password'] = trim($_POST['password']);

            //Validate id
            if (!empty($data['rid']) && !empty($data['password'])) {
                $result = $this->residentModel->add($data);

                if($result){
                    $data['message'] = "Resident successfully added.";
                    $this->view('users/admin/add-resident',$data);
                }
                else{
                    $data['addUserError'] = "An error occurred while creating user.";
                
                    $this->view('users/admin/add-resident',$data);
                }
            }
            $data['addUserError'] = "An error occurred while creating user.";
        }//END Check for POST
        $this->view('users/admin/add-resident',$data);
    }//END function addResident
}