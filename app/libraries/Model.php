<?php
abstract class Model{
    protected static $db =  'Database';
    public function __construct() {
        //$this->db = new Database;
    }
}
