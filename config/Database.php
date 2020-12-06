<?php

class Database {
    public $host = 'localhost';
    public $database = 'tasks';
    public $username = 'root';
    public $password = '';

    public function connect() {
        try {
            $mysqli = new mysqli($this->host, $this->username, $this->password, $this->database);
            // print(12345);
            return $mysqli;
        } catch (\Throwable $th) {
            // print($mysqli->connect_error);
            die();
        }
    }
}

?>