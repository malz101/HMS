<?php
class Issuess extends Controller {
    protected $model;
    public function __construct() {
        $this->model = $this->model('Issue');
    }

    public function resSubIssue(){
        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $data = [
                'rid' => trim($_POST['residentID']),
                'cluster' => trim($_POST['cluster']),
                'classification' => trim($_POST['classification']),
                'description' => trim($_POST['description']),
            ];

            //Validate id
            if (!empty($data['description'])) {
                $result = $this->model->addIssue($data);

                if($result){
                    $message = array(
                        'sess' => session_id(),//should be removed
                        'message' => "Issue is successfully logged."
                    );
                    $this->message($message)
                }
                else{
                    $message = array(
                        'sess' => session_id(),//should be removed
                        'message' => "Issue is log was unsuccessful."
                    );
                    $this->message($message)
                }
            }

        }
    }
}