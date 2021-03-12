<?php
class Users extends Controller {
    protected $model;
    public function __construct() {
        $this->model = $this->model('User');
    }

    public function login() {
        $data = [
            'title' => 'Login page',
            'id' => '',
            'password' => '',
            'idError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => trim($_POST['id']),
                'password' => trim($_POST['password']),
                'idError' => '',
                'passwordError' => '',
            ];
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
                $loggedInUser = $this->model->login($data['id'], $data['password']);
                // var_dump($loggedInUser);
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                    if(($loggedInUser->type)=='admin'){
                        $this->view('users/admin/admin.php');
                    }elseif (($loggedInUser->type)=='resident') {
                        $this->view('users/resident/confirmation.php');
                    }
                } else {
                    $data['passwordError'] = 'Password or id is incorrect. Please try again.';

                    echo json_encode(
                        array(
                            'sess' => session_id(),//should be removed
                            'loggedIn'=> -1,//user not found
                            'message' => "User Not Found"
                        )
                    ); 
                }
            }

        } else {
            $data = [
                'id' => '',
                'password' => '',
                'idError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('users/index', $data);
    }

    public function createUserSession($user) {
        $_SESSION['id'] = $user->id;
        $_SESSION['type'] = $user->type;
        header('location:' . URLROOT . '/pages/index');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['id']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . '/users/login');
    }

}