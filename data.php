<?php
include_once "config.php";

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Unable to connect to database");
if(!$connection){
    throw new Exception("Unable to connect to database");
}
else{
    echo "Connected to database";
    echo mysqli_query($connection, "INSERT INTO tasks(task,name) VALUES ('Do Something', '2023-05-16')");
    $result = mysqli_query($connection, "SELECT * FROM tasks");
    while($data = mysqli_fetch_assoc($result)){
        echo $data['task'] . "<br>";    
    }
}