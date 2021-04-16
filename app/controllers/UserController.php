<?php
class UserController extends Controller {
    protected $userModel;
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function login() {
        $data = array(
            'title' => 'Login page',
            'id' => '',
            'password' => '',
            'idError' => '',
            'passwordError' => '',
            'loginError' => ''
        );

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_SESSION);
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['id'] = trim($_POST['id']);
            $data['password'] = trim($_POST['password']);


            //Validate id
            if (empty($data['id'])) {
                $data['idError'] = 'Please enter a id.';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }

            //Check if all errors are empty
            if (empty($data['idError']) && empty($data['passwordError'])) {
                $userAuth = $this->userModel::getUserAuth($data['id']);
                
                //var_dump($userAuth);
                if (!empty($userAuth)) {
                    $hashedPassword = $userAuth->getPassword();
                    if (hash('sha256',$data['password'])==$hashedPassword) {
                        $this->createUserSession($userAuth);
                        $this->redirectUser($userAuth->getType());
                    }
                }else {
                    $data['loginError'] = 'Incorrect user id or password';
                    $this->view('users/login', $data);
                }
            }//END Check if all errors are empty
            $data['loginError'] = 'Incorrect user id or password';
        }//END Check for posts
        $this->view('users/login', $data);
    }

    public function createUserSession($userAuth) {
        $_SESSION['user_id'] = $userAuth->getUserID();
        $_SESSION['user_type'] = $userAuth->getType();
        // var_dump($_SESSION);
        // header('location:' . URLROOT . '/page/index');
    }

    private function redirectUser($type){
        switch ($type) {
            case "admin":
            header ( "Location: ".URLROOT."/admin/home");
            break;
            case "resident":
            header ( "Location: ".URLROOT."/resident/confirmation");
            break;
            case "mtnpersonnel":
            header ( "Location: ".URLROOT."/mtn/home");
            break;
        }//END switch
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_type']);
        header('location:' . URLROOT . '/page/index');
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
            $model = $this->model('Issue'); 
            switch($_SESSION['user_type']){
                
                case 'admin':
                    $data['issues'] = $this->attachMtnPersonnel($model::getAllIssuesbyFilter($data));
                    break;
                case 'resident':
                    $data['issues'] = $this->attachMtnPersonnel($model::getIssueByResIDFilter($data, $_SESSION['user_id']));
                    break;
                case 'mtnpersonnel':
                    $data['issues'] =  $this->attachMtnPersonnel($model::getIssueByMtnIDFilter($data, $_SESSION['user_id']));
                    break;
            }


            $this->helperViewAllIssues($data);
        }//END Check for POST
        else{
            $imodel = $this->model('Issue'); 
            switch($_SESSION['user_type']){
                case 'admin':
                     
                    $data['issues'] = $this->attachMtnPersonnel($imodel::getAllIssues());
                    break;
                case 'resident':
                    
                    $data['issues'] = $this->attachMtnPersonnel($imodel::getIssuesResByID($_SESSION['user_id']));
                    break;
                case 'mtnpersonnel':
                    $data['issues'] = $this->attachMtnPersonnel($imodel::getIssuesMtnByID($_SESSION['user_id']));
                    break;
            }

            $this->helperViewAllIssues($data);
        }
    }//END ViewAll

    protected function helperViewAllIssues($data){
        if(empty($data['issues'])){
            $data['message'] = "empty";
            $this->view('users/view-all-issues copy',$data);
        }else{
            $this->view('users/view-all-issues copy',$data);
        }
    }


    public function viewIssue($iid){
        $data = array(
            'iid' => $iid[0],
            'issue' => array(),
            'feedbacks' => array(),
            'commentError' => '',
            'giveFeedbackError' => '',
            'feedback-message' => '',
            'message' => '',
            'updateMessage'=>'',
            'updateIssueError' => '',
            'mtnpersonnels' => array()
        );

        
        $imodel = $this->model('Issue');
        $issue = $imodel::getIssue($data['iid']);
        $data['issue']  = $this->attachAllDetails(array($issue))[0];

        if($_SESSION['user_type']=='admin'){
            $mmodel = $this->model('MtnPersonnel');
            $data['mtnpersonnels'] = $mmodel::getAll();
        }
        
        // var_dump($data['issue']);
        if(empty($data['issue']) != false){
            $this->view('users/view-issue',$data);
        }
        else{
            $data['message'] = "empty";
        
            $this->view('users/view-issue',$data);
        }
    }//END viewIssue
 

    protected function attachMtnPersonnel($issues){
        $result = array();
        foreach ($issues as $issue) {
            $mtnmodel = $this->model('MtnPersonnel');
            array_push($result,array('issue'=>$issue,
                                    'mtn'=>$mtnmodel::get($issue->getAssigned()))); 
        }
        return $result;
    }

    protected function attachAllDetails($issues){
        $result = array();
        foreach ($issues as $issue) {
            $mtnmodel = $this->model('MtnPersonnel');
            $adminmodel = $this->model('Admin');
            $rmodel = $this->model('Resident');
            array_push($result,array('issue'=>$issue,
                                        'owner'=>$rmodel::get($issue->getOwnerID()),
                                        'mtn'=>$mtnmodel::get($issue->getAssigned()),
                                        'admin'=>$adminmodel::get($issue->getLastUpdatedBy())
            )); 
        }
        return $result;
    }


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

            $model = $this->model('Issue'); 
            switch($_SESSION['user_type']){ 
                case 'admin':
                    $data['issues'] = $this->attachMtnPersonnel($model::searchForIssue($data['key']));
                    break;
                case 'resident':
                    $data['issues'] = $this->attachMtnPersonnel($model::searchForIssuebyResID($data['key'], $_SESSION['user_id']));
                    break;
                case 'mtnpersonnel':
                    $data['issues'] = $this->attachMtnPersonnel($model::searchForIssuebyMtnID($data['key'], $_SESSION['user_id']));
                    break;
            }
            

            $this->helperViewAllIssues($data);
        }//END Check for POST
        else{
            header ( "Location: ".URLROOT."/user/viewAll");
        }
    }//END SEARCH FOR ISSUE


    protected function getIssueAndMtnPersonnel($iid){
        return array($this->issueModel->viewIssue($iid), $this->issueModel->getIssueFeedbacks($iid));
    }


}