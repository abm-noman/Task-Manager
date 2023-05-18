<?php
include_once "config.php";
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Unable to connect to database");
if(!$connection){
    throw new Exception("Unable to connect to database");
}

$query = "SELECT * FROM tasks ORDER BY date";
$result = mysqli_query($connection,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo/Tasks</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <style>
        body{
            margin-top: 30px;
        }
        #main{
            padding: 0px 150px 0px 150px;
        }
        #action{
            width: 150px;
        }
    </style>
</head>
<body>
    <div class="container" id="main">
        <h1>Tasks Manager</h1>
        <p>This is a sample project for managing our day to day life task. We are going to use HTML, CSS, PHP, JS for this project.</p>
        <h4>All Tasks</h4>
        <?php 
        if(mysqli_num_rows($result)==0){
            ?>
            <p>No Task Found</p>
        <?php
        }else{
        ?>
        <form action="">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Task</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($data = mysqli_fetch_assoc($result)){
                        $timestamp = strtotime($data['date']);
                        $date = date("jS M, Y", $timestamp);
                    ?>
                    <tr>
                        <td><input class="label-inline" type="checkbox" value="<?php echo $data['id']; ?>"></td>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['task']; ?></td>
                        <td><?php echo $data['date']; ?></td>
                        <td><a href="#">Delete</a> | <a href="#">Edit</a> | <a href="#">Complete</a></td>
                    </tr>
                    <?php
                    }
                    mysqli_close($connection);
                    ?>
                </tbody>
            </table>
            <select id="action">
                <option value="0">With Selected</option>
                <option value="del">Delete</option>
                <option value="edit">Edit</option>
                <option value="complete">Mark as Complete</option>
            </select>
            <input class="button-primary" type="submit" value="Submit">
        </form>
        <?php
        }
        ?>
        <p>...</p>
        <h4>Add Tasks</h4>
        <form method="POST" action="tasks.php">
            <fieldset>
                <?php
                    $added = $_GET['added']??'';
                    if($added){
                        echo '<p class="message-success">Task Added Successfully</p>';
                    }
                ?>
                <label for="task">Task</label>
                <input type="text" placeholder="Task Details" id="task" name="task">

                <label for="date">Date</label>
                <input type="date" placeholder="Task Date" id="date" name="date">

                <input class="button-primary" type="submit" value="Add Task">
                <input type="hidden" name="action" value="add">
            </fieldset>
    </div>
</body>
</html>