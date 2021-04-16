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

    public function scheduleRepair($iid){
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

            $data['slot'] = trim($_POST['slot']);

            //Validate description
            if (empty($data['iid'])) {
                $data['iidError'] = 'Please enter an issue ID.';
            }


            //Check if all errors are empty
            if (empty($data['iidError'])) {
                $imodel = $this->model('Issue');
                $smodel = $this->model('RepairScheduleSlot');

                $slot = new $smodel($iid,$_SESSION['user_id'],$data['slot']);

                $result = $smodel::book($slot);

                $data['issue'] = $this->attachAllDetails(array($imodel::getIssue($data['iid'])))[0];
                if($result){
                    $data['updateMessage'] = "Time Slot successfully booked.";
                    $this->view('users/view-issue',$data);
                }
                else{
                    $data['updateIssueError'] = "Time is already choosen.";
                
                    $this->view('users/view-issue',$data);
                }
            }
        }//END Check for POST
        $this->view('users/view-issue',$data);
    }//End updateIssue

    public function viewSchedule(){
        $data = array(
            'slots' => array(),
            'feedbacks' => array(),
            'commentError' => '',
            'giveFeedbackError' => '',
            'feedback-message' => '',
            'message' => '',
            'updateMessage'=>'',
            'updateIssueError' => '',
        );

        $rsmodel = $this->model('RepairScheduleSlot');
        $slots = $rsmodel::loadSlotForMtn($_SESSION['user_id']);
        $data['slots']  = $slots;

        // var_dump($slots);
        // var_dump($data['issue']);
        if($data['slots']){
            // var_dump($slots);
            $this->view('users/mtnpersonnel/view-schedule',$data);
        }
        else{
            $data['message'] = "empty";
        
            $this->view('users/mtnpersonnel/view-schedule',$data);
        }
    }//END viewSchedule
}