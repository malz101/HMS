<?php
class IssueController extends Controller {
    public function __construct() {
        $this->issueModel = $this->model('Issue');
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
                $result = $this->issueModel->addIssue($data);

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



    public function viewByResID(){
        $data=[];
        $data = array(
            'issues' => array(),
            'status' => '',
            'classification' => '',
            'message' => ''
        );

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['status'] = trim($_POST['status']);
            $data['classification'] = trim($_POST['classification']);

            $data['issues'] = $this->issueModel->viewAllIssuesbyFilter($data);

            //Check if all errors are empty
            if(empty($data['issues'])){
                $data['message'] = "empty";
                $this->view('users/view-all-issues copy',$data);
            }else{
                $this->view('users/view-all-issues copy',$data);
            }
        }//END Check for POST
        else{
            $data['issues'] = $this->issueModel->viewAllIssues();

            if(empty($data['issues'])){
                $data['message'] = "empty";
                $this->view('users/view-all-issues copy',$data);
            }else{
                $this->view('users/view-all-issues copy',$data);
            }
        }
    }//END ViewAll

    public function viewIssue($iid){
        $data=[];
        $data = array(
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

        $data['issue']  = $this->getIssueAndFeedbacks($data['iid']);
        // var_dump($data['issue']);
        if(empty($data['issue']) != false){
            $this->view('users/view-issue',$data);
        }
        else{
            $data['message'] = "empty";
        
            $this->view('users/view-issue',$data);
        }
    }
    
    public function updateIssue($iid){
        $data=[];
        $data = array(
            'title' => 'Log Issue Page',
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
                $result = $this->issueModel->updateIssue($data);
                $data['issue'] = $this->getIssueAndFeedbacks($data['iid']);
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
                $result = $this->issueModel->addFeedback($data);
                $data['issue'] = $this->getIssueAndFeedbacks($data['iid']);
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


    private function getIssueAndFeedbacks($iid){
        return array($this->issueModel->viewIssue($iid), $this->issueModel->getIssueFeedbacks($iid));
    }


    public function viewAll(){
        $data=[];
        $data = array(
            'issues' => array(),
            'status' => '',
            'classification' => '',
            'message' => ''
        );

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['status'] = trim($_POST['status']);
            $data['classification'] = trim($_POST['classification']);

            $data['issues'] = $this->issueModel->viewAllIssuesbyFilter($data);

            //Check if all errors are empty
            if(empty($data['issues'])){
                $data['message'] = "empty";
                $this->view('users/view-all-issues copy',$data);
            }else{
                $this->view('users/view-all-issues copy',$data);
            }
        }//END Check for POST
        else{
            $data['issues'] = $this->issueModel->viewAllIssues();

            if(empty($data['issues'])){
                $data['message'] = "empty";
                $this->view('users/view-all-issues copy',$data);
            }else{
                $this->view('users/view-all-issues copy',$data);
            }
        }
    }//END ViewAll

    public function searchForIssue(){
        $data=[];
        $data = array(
            'issues' => array(),
            'status' => '',
            'classification' => '',
            'key' => '',
            'message' => ''
        );

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['key'] = trim($_POST['key']);

            if(empty($data['key'])){
                $data['key'] = "%";
            }

            $data['issues'] = $this->issueModel->searchForIssue($data['key']);

            //Check if all errors are empty
            if(empty($data['issues'])){
                $data['message'] = "empty";
                $this->view('users/view-all-issues copy',$data);
            }else{
                $this->view('users/view-all-issues copy',$data);
            }
        }//END Check for POST
        else{
            $data['issues'] = $this->issueModel->viewAllIssues();

            if(empty($data['issues'])){
                $data['message'] = "empty";
                $this->view('users/view-all-issues copy',$data);
            }else{
                $this->view('users/view-all-issues copy',$data);
            }
        }
    }
}