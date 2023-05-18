<?php
//$action = isset($_POST['action']) ? $_POST['action'] : '';
include_once ('config.php');

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Unable to connect to database");
if(!$connection){
    throw new Exception("Unable to connect to database");
}
else{        
    $action = $_POST['action'] ?? '';
    if(!$action){
        header('Location: index.php');
        die();
    }
    else{
        if('add' == $action){
            $task = $_POST['task'] ?? '';
            $date = $_POST['date'] ?? '';

            if ($task && $date) {
                $query = "INSERT_INTO".DB_TABLE."(task.date) VALUES('$task','$date')";
                $result = mysqli_query($connection, $query);
                if ($result) {
                    header('Location: index.php');
                    die();
                    }
            }
        }
    }
}
?>