<?php
class Pages extends Controller {
    public function __construct() {
        //$this->userModel = $this->model('User');
    }

    public function index() {
        $data = [];
        $this->view('index', $data);
    }

    public function loginPage(){
        $data = array(
            'title' => 'Home page'
        );
        $this->view('users/login', $data);        
    }
}
