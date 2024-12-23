<?php 

session_start();
if(!isset($_SESSION['login'])) {
    header('Location: login.php');
}
include "conn.php"; 
function delete($conn,$ids) {
    $sql = "DELETE FROM user_form WHERE id IN ($ids)";
      $result = $conn->query($sql);
      if ($result == TRUE) {
         $_SESSION['success'] = "Records deleted successfully.";
         header('Location: view.php');
 
     }else{
         echo "Error:" . $sql . "<br>" . $conn->error;
     }
}


if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    delete($conn,$user_id);
} 

header('Location: view.php');
