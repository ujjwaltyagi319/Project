<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header('Location: login.php');
}
include "conn.php";
if(isset($_POST['submit'])){
        $user_id = $_POST['user_id'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $addres = $_POST['addres'];
        $sql = "UPDATE user_form SET firstname = '$firstname', email ='$email',mobile = '$mobile',addres ='$addres' WHERE  id='$user_id'"; 
        $result = $conn->query($sql); 

        if ($result == TRUE) {
            $_SESSION['success'] = "Records update successfully.";
            header('Location: view.php');
            
           // echo "Record updated successfully.";
        }else{
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }
    
if (isset($_GET['id'])) {
    $user_id = $_GET['id']; 
    $sql = "SELECT * FROM `user_form` WHERE `id`='$user_id'";
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) {  
        while ($row = $result->fetch_assoc()) {
            $firstname = $row['firstname'];
            $email = $row['email'];
            $mobile = $row['mobile'];
            $addres  = $row['addres'];   
        } 
    ?>
        <h2>User Update Form</h2>
        <form action="" method="POST">
          <fieldset>
            firstname:<br>
            <input type="text" name="firstname" value="<?php echo $firstname; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <br>
            email:<br>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <br>
            mobile:<br>
            <input type="mobile" name="mobile" value="<?php echo $mobile; ?>">
            <br>
            password:<br>
            <input type="password" name="password" value="<?php echo $password; ?>">
            <br>
            addres:<br>
            <input type="addres" name="addres" value="<?php echo $addres; ?>">
            <br>
            <input type="submit" value="Update" name="submit">
          </fieldset>
        </form> 
        </body>
        </html> 
    <?php
    } 
}

?> 
