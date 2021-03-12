<?php
class Admin extends Users {
    public function __construct() {
        $this->model = $this->model('Admin');
    }

}