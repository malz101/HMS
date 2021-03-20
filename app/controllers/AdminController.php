<?php
require_once 'UserController.php';
class AdminController extends UserController {
    public function __construct() {
        $this->adminModel = $this->model('Admin');
    }

    public function home(){
        $data=array('title' => 'Admin Home Page');
        $this->view('/users/admin/admin',$data);
    }

    // public function addResident(){
    //     $data=array('title' => 'Add Resident');
    //     $this->view('/users/admin/add-resident',$data);
    // }

    // public function adddMtnPersonnel(){
    //     $data=array('title' => 'Add Maintenance');
    //     $this->view('/users/admin/add-mtn-personnel',$data);
    // }

    // public function updateIssue(){
    //     $data=array('title' => 'Update Issue Progress');
    //     $this->view('/users/admin/update-issue',$data);
    // }

    // public function viewFeedback(){
    //     $data=array('title' => 'View Feedback');
    //     $this->view('/users/admin/view-feedback',$data);
    // }
}