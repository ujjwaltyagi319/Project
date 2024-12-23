<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header('Location: login.php');
}
include "conn.php";

$sql = "SELECT * FROM user_form order by id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>

<html>

<head>

    <title>View Page</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>

<body>

    <div class="container">
    <?php if(isset($_SESSION['success'] ) && (!empty($_SESSION['success'] ))) { 
        $msg = $_SESSION['success'];
        unset($_SESSION['success']);
        ?> 
        <div class="alert alert-success" role="alert">
            <?php echo $msg; ?>
        </div>
        <?php } ?>
        <?php if(isset($_SESSION['error'] ) && (!empty($_SESSION['error'] ))) { 
        $msg = $_SESSION['error'];
        unset($_SESSION['error']);
        ?> 
        <div class="alert alert-danger" role="alert">
            <?php echo $msg; ?>
        </div>
        <?php } ?>
        <h2>users</h2>
        <a class="btn btn-info" href="project.php">ADD</a>
        <a class="btn btn-info" href="logout.php">LOGOUT</a>

<table class="table">
    <thead>
        <tr>
        <th>firstname</th>
        <th>email</th>
        <th>mobile</th>
        <th>address</th>
        <th>Action</th>
    </tr>

    </thead>

    <tbody> 

        <?php

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

        ?>
                    <tr>
                    <td><?php echo $row['firstname']; ?></td>

                    <td><?php echo $row['email']; ?></td>

                    <td><?php echo $row['mobile']; ?></td>

                    <td><?php echo $row['addres']; ?></td>

                    <td><a class="btn btn-info" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;<a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>

                    </tr>

        <?php       }

            }

        ?>                

    </tbody>

</table>
    </div>
 

</body>

</html>