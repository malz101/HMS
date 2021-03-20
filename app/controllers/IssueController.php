<?php
class IssueController extends Controller {
    public function __construct() {
        $this->issueModel = $this->model('Issue');
    }

    public function logIssue(){
        $data = array(
            'title' => 'Log Issue Page',
            'rid' => '',
            'classification'=>'',
            'description' => '',
            'message' => '',
            'descriptionError' => '',
            'logIssueError' => ''
        );

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['rid'] = $_SESSION['user_id'];
            $data['classification'] = trim($_POST['classification']);
            $data['description'] = trim($_POST['description']);

            //Validate description
            if (empty($data['description'])) {
                $data['descriptionError'] = 'Please enter an issue description.';
            }


            //Check if all errors are empty
            if (empty($data['descriptionError'])) {
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


    public function viewAll(){
        $data = array(
            'issues' => array(),
            'message' => ''
        );

        $data['issues'] = $this->issueModel->viewAllIssues();

        if(!empty($issues)){
            $this->view('users/admin/view-all-issues',$data);
        }
        else{
            $data['message'] = "No issues were found.";
        
            $this->view('users/admin/view-all-issues',$data);
        }
    }

    public function viewIssuesByHallMemberID(){
        $data = array(
            'issues' => array(),
            'message' => ''
        );

        $data['issues'] = $this->issueModel->viewIssuesByHallMemberID($_SESSION['user_id']);

        if(!empty($issues)){
            $this->view('users/resident/view-all-issues',$data);
        }
        else{
            $data['message'] = "No issues were found.";
        
            $this->view('users/resident/view-all-issues',$data);
        }
    }
    
    public function updateIssue(){
        $data = array(
            'title' => 'Log Issue Page',
            'iid' => '',
            'status'=>'',
            'message' => '',
            'iidError' => '',
            'updateIssueError' => ''
        );

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['iid'] = trim($_POST['iid']);
            $data['status'] = trim($_POST['status']);

            //Validate description
            if (empty($data['iid'])) {
                $data['iidError'] = 'Please enter an issue ID.';
            }


            //Check if all errors are empty
            if (empty($data['iidError'])) {
                $result = $this->issueModel->updateIssue($data);

                if($result){
                    $data['message'] = "Issue successfully updated.";
                    $this->view('users/admin/update-issue',$data);
                }
                else{
                    $data['updateIssueError'] = "Issue update unsuccessful.";
                
                    $this->view('users/admin/update-issue',$data);
                }
            }
        }//END Check for POST
        $this->view('users/admin/update-issue',$data);
    }
}