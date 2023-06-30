<?php
session_start();
include("connection.php");

if (isset($_POST['changepassword'])) {
    header("Location: changepassword.php");
    exit();
}
if (isset($_POST['signin'])) {
    $inputUserID = $_POST["id"];
    $inputPassword = $_POST["password"];

    if ($inputUserID == null || $inputPassword == null) {
        echo '<script>alert("Please fill all the fields")</script>';
        echo "<script>window.location.href = 'index.php'</script>";
        exit();
    }

    $query = "SELECT * FROM `User` WHERE id = '$inputUserID' AND password = '$inputPassword';";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) <= 0) {
        echo '<script>alert("Invalid credentials")</script>';
        echo "<script>window.location.href = 'index.php'</script>";
        exit();
    }

    $_SESSION['user_id'] = $inputUserID; 
    header("Location: orderitemform.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <!--
    ID : 313
    Password : developer313
    -->
    <div class="form">
        <form action="index.php" method="post" class="login-form">
            <div class="id-input">
                <label for="id">ID</label>
                <input type="text" id="id" name="id">
            </div>
            <div class="password-input">
                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="buttons">
                <button type="submit" name="signin" class="button sign-in">Sign-IN</button>
                <button type="submit" name="changepassword" class="button change-password">Change Password</button>
            </div>
        </form>
    </div>
</body>

</html>