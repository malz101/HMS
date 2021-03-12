<?php
class Users extends Controller {
    private $userModel;
    public function __construct() {
        $this->userModel = $this->model('User');
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
                $loggedInUser = $this->userModel->login($data['id'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Password or id is incorrect. Please try again.';

                    $this->view('users/index', $data);
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
        header('location:' . URLROOT . '/pages/index');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['id']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . '/users/login');
    }
}