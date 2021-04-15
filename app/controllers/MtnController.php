<?php
require_once 'UserController.php';
class MtnController extends UserController {
    public function __construct() {
        $this->mtnModel = $this->model('MtnPersonnel');
    }

    public function home(){
        $data=array('title' => 'Resident Home Page');
        $this->view('/users/mtnpersonnel/mtnpersonnel',$data);
    }

}