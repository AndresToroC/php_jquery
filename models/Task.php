<?php

require_once '../config/Database.php';

class Task extends Database {
    public function __construct() {
        date_default_timezone_set('America/Bogota');
    }

    public function lists() {
        $conn = parent::connect();

        $sql = "SELECT * FROM tasks";
        // $tasks = mysqli_query($conn, $sql);
        $tasks = $conn->query($sql);
        $conn->close();
        
        return $tasks;
    }

    public function create($name, $description) {
        $conn = parent::connect();
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO tasks(name, description, created_at, updated_at) VALUES ('$name', '$description', '$created_at', '$updated_at')";
        $task = mysqli_query($conn, $sql);

        return $task;
    }

    public function edit($task_id) {
        $conn = parent::connect();

        $sql = "SELECT * FROM tasks WHERE id = $task_id";
        $task = mysqli_query($conn, $sql);

        return $task->fetch_array();
    }

    public function update($task_id, $name, $description) {
        $conn = parent::connect();
        $updated_at = date('Y-m-d H:i:s');

        $sql = "UPDATE tasks SET name = '$name', description = '$description' WHERE id = $task_id";
        $task = mysqli_query($conn, $sql);

        return $task;
    }

    public function destroy($task_id) {
        $conn = parent::connect();

        $sql = "DELETE FROM tasks WHERE id = $task_id";
        mysqli_query($conn, $sql);
    }
}

?>