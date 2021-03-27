<?php
require_once 'UserController.php';
class MtnController extends UserController {
    public function __construct() {
        $this->mtnModel = $this->model('MtnPersonnel');
    }

    public function home(){
        $data=array('title' => 'Resident Home Page');
        $this->view('/users/mtnpersonnel/mtnpersonnel',$data);
    }

    public function addMtnPersonnel(){
        $data = array(
            'title' => 'Add Resident Page',
            'mid' => '',
            'fname' => '',
            'lname' => '',
            'tele' => '',
            'email' => '',
            'affiliation' => '',
            'message' => '',
            'idError' => '',
            'teleError' => '',
            'emailError' => '',
            'affiliationError' => '',
            'addUserError' => ''
        );


        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data['mid'] = trim($_POST['mid']);
            $data['fname'] = trim($_POST['fname']);
            $data['lname'] = trim($_POST['lname']);
            $data['tele'] = trim($_POST['tele']);
            $data['email'] = trim($_POST['email']);
            $data['affiliation']= trim($_POST['affiliation']);
            $data['password'] = trim($_POST['password']);

            //Validate id
            if (!empty($data['mid']) && !empty($data['password'])) {
                $result = $this->mtnModel->add($data);

                if($result){
                    $data['message'] = "Maintennance successfully added.";
                    $this->view('users/admin/add-mtn-personnel',$data);
                }
                else{
                    $data['addUserError'] = "An error occurred while creating user.";
                
                    $this->view('users/admin/add-mtn-personnel',$data);
                }
            }
            $data['addUserError'] = "An error occurred while creating user.";
        }//END Check for POST
        $this->view('users/admin/add-mtn-personnel',$data);
    }//END function addResident
}