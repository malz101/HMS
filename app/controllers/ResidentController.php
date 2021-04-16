<?php
require_once 'UserController.php';
class ResidentController extends UserController {
    public function __construct() {
        parent::__construct();
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

    public function logIssue(){
        $data=[];
        $data = array(
            'title' => 'Log Issue Page',
            'rid' => '',
            'subject' => '',
            'classification'=>'',
            'description' => '',
            'message' => '',
            'subjectError' => '',
            'descriptionError' => '',
            'logIssueError' => ''
        );

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['rid'] = $_SESSION['user_id'];
            $data['subject'] = trim($_POST['subject']);
            $data['classification'] = trim($_POST['classification']);
            $data['description'] = trim($_POST['description']);

            //Validate subject
            if (empty($data['subject'])) {
                $data['subjectError'] = 'Please enter a subject.';
            }

            //Validate description
            if (empty($data['description'])) {
                $data['descriptionError'] = 'Please enter an issue description.';
            }


            //Check if all errors are empty
            if (empty($data['descriptionError'])  && empty($data['subjectError'])) {
                $imodel = $this->model('Issue');
                $issue = new $imodel($data['rid'],$data['subject'], $data['classification'], $data['description']);
                $result = $imodel::add($issue);

                if(!empty($result)){
                    $data['message'] = "Issue is successfully logged.";
                    $this->view('users/resident/log-issue',$data);
                }
                else{
                    $data['logIssueError'] = "Issue log was unsuccessful.";
                    $this->view('users/resident/log-issue',$data);
                }
            }
            $data['logIssueError'] = "Issue log was unsuccessful.";
        }//END Check for POST
        $this->view('users/resident/log-issue',$data);
    }//END function logIssue




    public function logFeedback($iid){
        $data=[];
        $data = array(
            'title' => 'View Isuue Page',
            'iid' => $iid[0],
            'issue' => array(),
            'feedbacks'=>'',
            'commentError' => '',
            'giveFeedbackError' => '',
            'feedback-message' => '',
            'message' => ''
        );

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['comment'] = trim($_POST['comment']);
            $data['uid'] = $_SESSION['user_id'];


            //validate comment
            if (empty($data['comment'])) {
                $data['commentError'] = 'Please enter an a comment.';
            }

            //Check if all errors are empty
            if (empty($data['commentError'])) {
                $imodel = $this->model('Issue');
                $fmodel = $this->model('Feedback');

                $feedback = new $fmodel($data['iid'], $data['uid'],$data['comment']);
                $result = $fmodel::add($feedback);

                $issue = $imodel::getIssue($data['iid']);
                
                $data['issue'] = $this->attachAllDetails(array($issue))[0];
                if($result){
                    $data['feedback-message'] = "Feedback successfully added.";
                    $this->view('users/view-issue',$data);
                }
                else{
                    $data['giveFeedbackError'] = "Feedback log was unsuccessful.";
                    $this->view('users/view-issue',$data);
                }
            }
            $data['giveFeedbackError'] = "Feedback log was unsuccessful.";
        }//END Check for POST
        $this->view('users/view-issue',$data);
    }//END function resSubIssue


}