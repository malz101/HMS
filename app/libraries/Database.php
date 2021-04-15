<?php
class Database {
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct() {
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //Allows us to write queries
    public function query($sql) {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    //Bind values
    public function bind($parameter, $value, $type = null) {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($parameter, $value, $type);
    }

    //Execute the prepared statement
    public function execute() {
        return $this->statement->execute();
    }

    //Return an array
    public function resultSet($class) {
        clearstatcache();
        $this->execute();
        $model = $this->model($class);
        $this->statement->setFetchMode(PDO::FETCH_CLASS,$model);
        return $this->statement->fetchAll();
    }

    //Return a specific row as an object
    public function single($class) {
        clearstatcache();
        $this->execute();
        $model = $this->model($class);
        //require_once '../app/models/' . $class . '.php';
        //var_dump($model);
        $this->statement->setFetchMode(PDO::FETCH_CLASS,$model);
        return $this->statement->fetch();
    }

    //Get's the row count
    public function rowCount() {
        return $this->statement->rowCount();
    }

    private function model($model) {
        //Require model file
        require_once '../app/models/' . $model . '.php';
        //Instantiate model
        return $model;
    }

}

?>