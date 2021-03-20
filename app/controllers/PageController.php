<?php
class PageController extends Controller {
    public function __construct() {
        //$this->userModel = $this->model('User');

    }

    public function index() {
      
      $view_n = 'users/login';
      // var_dump($_SESSION);
      // if(isset($_SESSION['user_id']) && isset($_SESSION['user_type'])){
      //     $user_type = $_SESSION['user_type'];
      //     switch ($user_type) {
      //       case "admin":
      //         var_dump($user_type);
      //         header ( "Location: ".URLROOT."/admin/admin");
      //         break;
      //       case "resident":
      //         header ( "Location: ".URLROOT."/resident/resident");
      //         break;
      //       case "mtnpersonnel":
      //         header ( "Location: ".URLROOT."/mtnpersonnel/mtnpersonnel");
      //         break;
      //     }//END switch
      // } 
      // $data = array('title' => 'Login page');
      // $this->view($view_n, $data);
      header ( 'location:'.URLROOT. '/user/login');
    }

    // public function loginPage(){
    //     $data = array(
    //         'title' => 'Home page'
    //     );
    //     $this->view('users/login', $data);        
    // }
}
