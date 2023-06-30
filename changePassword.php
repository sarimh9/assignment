<?php

include("connection.php");

if (isset($_POST['submit'])) {
    $mobileno = $_POST['mobileno'];
    $newPassword = $_POST['newpassword'];
    $confirmPassword = $_POST['confirmpassword'];

    if ($newPassword != $confirmPassword) {
        echo "Passwords do not match.";
    } else {
        $query = "SELECT * FROM User WHERE phone_number = '$mobileno'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) <= 0) {
            echo '<script>alert("Mobile Number NOT Matched !")</script>';
            echo "<script>window.location.href = 'changePassword.php'</script>";
            exit();
        }
        if (mysqli_num_rows($result) > 0) {
            $updateQuery = "UPDATE User SET password = '$newPassword' WHERE phone_number = '$mobileno'";
            if (mysqli_query($conn, $updateQuery)) {
                echo '<script>alert("Password updated successfully")</script>';
                echo "<script>window.location.href = 'index.php'</script>";
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Change Password</title>
</head>

<body>
    <div class="form">
        <form method="post" class="change-password-form">
            <div class="mobile-input input-box">
                <label for="mobileno">Enter MobileNo</label>
                <input type="number" id="mobileno" name="mobileno">
            </div>
            <div class="new-password-input input-box">
                <label for="newpassword">New Password</label>
                <input type="password" id="newpassword" name="newpassword">
            </div>
            <div class="confirm-password-input input-box">
                <label for="confirmpassword">Confirm New Password</label>
                <input type="password" id="confirmpassword" name="confirmpassword">
            </div>
            <button class="update-password-btn" name="submit" type="submit">UPDATE PASSWORD</button>
        </form>
    </div>
</body>

</html>