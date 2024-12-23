<?php
session_start();
if(!isset($_SESSION['login'])) {
    header('Location: login.php');
}
include "conn.php";
function inputclean($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$firstnameError = $emailError = $mobileError = $addresError = [];
$firstname = $email = $mobile = $addres ='';
$error = false;

if (isset($_POST['submit'])) {
  $firstname = $_POST['firstname'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $addres = $_POST['addres'];

  if (empty($firstname)) {
    $error = true;
    $firstnameError[] = "name is mandatory";
  } else {
    $firstname = inputclean($firstname);
    if (!preg_match("/^[a-zA-Z-']*$/", $firstname)) {
      $error = true;
      $firstnameError[] = "only latters is allowd";
    }
  }

  if (empty($email)) {
    $error = true;
    $emailError[] = "email is mandatory";
  } else {
    $email = inputclean($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
      $error = true;
      $emailError[] = "Email must be in email format.";
    }
  }

  $mobile = inputclean($mobile);
  if (empty($mobile)) {
    $error = true;
    $mobileError[] = "mobile is mandatory";
  }
  if (!preg_match('/^\\d+$/', $mobile)) {
    $error = true;
    $mobileError[] = "only numeric is allowd";
  }
  if (strlen($mobile) > 10 || strlen($mobile) < 10) {
    $error = true;
    $mobileError[] = "size is 10";
  }

if(!$error){
    $sql = "INSERT INTO `user_form`(firstname,email,mobile, addres)VALUES (  '$firstname','$email','$mobile','$addres')";
    $result = $conn->query($sql);
    if ($result == TRUE) {
      $_SESSION['success'] = "Records created successfully.";
      //echo "New record created successfully.";
      header('Location: view.php');
    } else {
      echo "Error:" . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }
}

?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<body>
  <div class = "container">
    <h1>User create form</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <label for="fname">firstname:</label><br>
      <input type="text" id="fname" name="firstname" value="<?php echo $firstname; ?>"><br>
      <?php if (!empty($firstnameError)) { ?>
        <span class="errorColor">*<?php echo implode('.', $firstnameError);; ?></span><br>
      <?php } ?>

      <label for="email">email:</label><br>
      <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>
      <?php if (!empty($emailError)) { ?>
        <span class="errorColor">*<?php echo implode('.', $emailError);; ?></span><br>
      <?php } ?>
      <label for="mobile">mobile:</label><br>
      <input type="text" id="mobile" name="mobile" value="<?php echo $mobile; ?>"><br>
      <?php if (!empty($mobileError)) { ?>
        <span class="errorColor">*<?php echo implode('.', $mobileError);; ?></span><br>
      <?php } ?>
      <label for="addres">addres</label><br>
      <input type="text" id="addres" name="addres" value=""><br><br>
      <?php if (!empty($addresError)) { ?>
        <span class="errorColor">*<?php echo implode('.', $addresError);; ?></span><br>
      <?php } ?>
      

      <input type="submit" value="Submit" name="submit" class="btn btn-info">
    

    </form>
  </div>
</body>

</html>