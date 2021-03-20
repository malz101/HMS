<?php
class UserController extends Controller {
    private $model;
    public function __construct() {
        $this->model = $this->model('User');
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
            // var_dump($_SESSION);
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
                $userAuth = $this->model->getUserAuth($data['id']);

                // var_dump($loggedInUser);
                if (!empty($userAuth)) {
                    $hashedPassword = $userAuth['password'];
                    if (hash('sha256',$data['password'])==$hashedPassword) {
                        $this->createUserSession($userAuth);
                        $this->redirectUser($userAuth['type']);
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

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['type'];
        // var_dump($_SESSION);
        // header('location:' . URLROOT . '/page/index');
    }

    private function redirectUser($type){
        switch ($type) {
            case "admin":
            var_dump($type);
            header ( "Location: ".URLROOT."/admin/home");
            break;
            case "resident":
            header ( "Location: ".URLROOT."/resident/home");
            break;
            case "mtnpersonnel":
            header ( "Location: ".URLROOT."/mtnpersonnel/home");
            break;
        }//END switch
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_type']);
        header('location:' . URLROOT . '/page/index');
        echo 'stopep';
    }

}