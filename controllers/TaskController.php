<?php

require_once '../config/Database.php';
require_once '../models/Task.php';

$taskModel = new Task();

switch ($_GET['tasks']) {
    case 'listAll':
        $tasks = $taskModel->lists();
        $lists = array();

        foreach ($tasks as $task) {
            $array = array();
            $array[] = $task['id'];
            $array[] = $task['name'];
            $array[] = '<div class="flex justify-end">
                            <button onClick="edit('.$task['id'].')" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                            <button onClick="deletet('.$task['id'].')" class="ml-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                        </div>';

            $lists[] = $array;
        }

        $data = array(
            // 'sEcho' => 1,
            // 'iTotalRecords' => count($lists),
            // 'iTotalDisplayRecords' => count($lists),
            'aaData' => $lists
        );

        echo json_encode($data);

        break;

    case 'create':
        $task = $_POST['task'];
        
        $name = $task['name'];
        $description = $task['description'];

        $task = $taskModel->create($name, $description);

        break;

    case 'edit':
        $task_id = $_POST['task_id'];
        $task = $taskModel->edit($task_id);

        echo json_encode($task);

        break;
    
    case 'update':
        $task_P = $_POST['task'];
        $task_id = $task_P['id'];
        $name = $task_P['name'];
        $description = $task_P['description'];

        $task = $taskModel->update($task_id, $name, $description);

        echo json_encode($task);

        break;

    case 'delete':
        $task_id = $_POST['task_id'];

        $taskModel->destroy($task_id);

        break;

    default:
        return 2;
        break;
}

?>