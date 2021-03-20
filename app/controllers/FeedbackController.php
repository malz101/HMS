<?php
class FeedbackController extends Controller {
    public function __construct() {
        $this->feedbackModel = $this->model('Feedback');
    }

    public function logFeedback(){
        $data = array(
            'title' => 'Give Feedback Page',
            'iid' => '',
            'comment'=>'',
            'message' => '',
            'iidError' => '',
            'commentError' => '',
            'giveFeedbackError' => ''
        );

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['iid'] = trim($_POST['iid']);
            $data['comment'] = trim($_POST['comment']);
            $data['uid'] = $_SESSION['user_id'];

            //Validate issue id
            if (empty($data['iid'])) {
                $data['iidError'] = 'Please enter an issue ID.';
            }

            //validate comment
            if (empty($data['comment'])) {
                $data['commentError'] = 'Please enter an a comment.';
            }

            //Check if all errors are empty
            if (empty($data['iidError']) && empty($data['commentError'])) {
                $result = $this->feedbackModel->addFeedback($data);

                if(!empty($result)){
                    $data['message'] = "Feedback successfully added.";
                    $this->view('users/resident/give-feedback',$data);
                }
                else{
                    $data['giveFeedbackError'] = "Feedback log was unsuccessful.";
                    $this->view('users/resident/give-feedback',$data);
                }
            }
            $data['giveFeedbackError'] = "Feedback log was unsuccessful.";
        }//END Check for POST
        $this->view('users/resident/give-feedback',$data);
    }//END function resSubIssue
    
}
