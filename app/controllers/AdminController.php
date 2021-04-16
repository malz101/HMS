<?php
require_once 'UserController.php';
class AdminController extends UserController {
    public function __construct() {
        $this->adminModel = $this->model('Admin');
    }

    public function home(){
        $data=array('title' => 'Admin Home Page');
        $this->view('/users/admin/admin',$data);
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
                $rmodel = $this->model('Resident');
                $resident = new $rmodel($data['rid'],$data['fname'],$data['lname'],$data['cluster'],
                                        $data['household'],$data['rnum']);

                $result = $rmodel::add($resident,$data['password']);

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


    public function addMtnPersonnel(){
        $data = array(
            'title' => 'Add Resident Page',
            'mid' => '',
            'fname' => '',
            'lname' => '',
            'tele' => '',
            'email' => '',
            'affiliation' => '',
            'skills_desc' => '',
            'message' => '',
            'idError' => '',
            'teleError' => '',
            'emailError' => '',
            'affiliationError' => '',
            'descriptionError' => '',
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
            $data['skills_desc'] = trim($_POST['skills_desc']);

            //Validate id
            if (!empty($data['mid']) && !empty($data['password'])) {
                $mmodel = $this->model('MtnPersonnel');
                $mtn = new $mmodel($data['mid'],$data['fname'],$data['lname'],$data['tele'],
                                    $data['email'],$data['affiliation'],$data['skills_desc']);
                                    
                $result = $this->mmodel::add($mtn,$data['password']);

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
    }//END function addMtnPesonnel


    public function updateIssueStatus($iid){
        $data=[];
        $data = array(
            'title' => 'View Issue Page',
            'iid' => $iid[0],
            'issue' => array(),
            'feedbacks' => array(),
            'commentError' => '',
            'giveFeedbackError' => '',
            'feedback-message' => '',
            'message' => '',
            'updateMessage'=>'',
            'updateIssueError' => ''
        );

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['status'] = trim($_POST['status']);

            //Validate description
            if (empty($data['iid'])) {
                $data['iidError'] = 'Please enter an issue ID.';
            }


            //Check if all errors are empty
            if (empty($data['iidError'])) {
                $model = $this->model('Issue');
                $result = $model::updateIssue($data);
                $data['issue'] = $this->attachAllDetails(array(Issue::getIssue($data['iid'])))[0];
                if($result){
                    $data['updateMessage'] = "Issue successfully updated.";
                    $this->view('users/view-issue',$data);
                }
                else{
                    $data['updateIssueError'] = "Issue update unsuccessful.";
                
                    $this->view('users/view-issue',$data);
                }
            }
        }//END Check for POST
        $this->view('users/view-issue',$data);
    }//End updateIssue


    public function assignPersonnel($iid,$mid){
        $imodel = $this->model('Issue');
        $result = $imodel::assignPersonnel($iid,$mid);
        
        if($result){
          $this->redirectToIssue($iid);  
        }
    }

    private function redirectToIssue($iid){
        header ( "Location: ".URLROOT."/user/viewIssue/".$iid);
    }
}