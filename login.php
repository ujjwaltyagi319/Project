
<?php
session_start();
include "conn.php";

$usernameError = $passwordError = [];
$error = false;

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username)) {
        $error = true;
        $usernameError[] = "Username is mandatory";
    }

    if (empty($password)) {
        $error = true;
        $passwordError[] = "Password is mandatory";
    }

    if (!$error) {
        $sql = "Select * FROM `admins` where username ='$username' AND password = '$password'";
        $results = $conn->query($sql);
        if ($results->num_rows > 0) {
            $_SESSION['login'] = ($results->fetch_assoc())['username'];
            header('Location: view.php');
        } else {
            $login_failed = true;
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
    <div class="container">
        <?php if(isset($login_failed ) && $login_failed  == true) { ?> 
        <div class="alert alert-danger" role="alert">
            Login Failed.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        </div>
        <?php } ?>
        <h1>Login form</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value=""><br>
            <?php if (!empty($usernameError)) { ?>
                <span class="errorColor">*<?php echo implode('.', $usernameError);; ?></span><br>
            <?php } ?>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" value=""><br>
            <?php if (!empty($passwordError)) { ?>
                <span class="errorColor">*<?php echo implode('.', $passwordError);; ?></span><br>
            <?php } ?>
            <input type="submit" value="Submit" name="submit" class="btn btn-info">
        </form>
    </div>
</body>

</html>