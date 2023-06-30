<?php
session_start();
include("connection.php");
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$id = $_SESSION['user_id'];
$nameQuery = "SELECT name FROM `User` WHERE id = '$id';";
$nameResult = mysqli_query($conn, $nameQuery);
if ($row = mysqli_fetch_assoc($nameResult)) {
    $name = $row['name'];
}

if (isset($_POST['submit'])) {
    $product = $_POST['product'];
    $productSearchQuery = "SELECT id FROM ProductInfo WHERE species = '$product';";
    $productResult = mysqli_query($conn, $productSearchQuery);

    if ($productResult && mysqli_num_rows($productResult) > 0) {
        $productRow = mysqli_fetch_assoc($productResult);
        $productID = $productRow['id'];

        $orderdate = $_POST['orderdate'];
        $count = $_POST['count'];
        $weight = $_POST['weight'];
        $requests = $_POST['requests'];

        $insertQuery = "INSERT INTO OrderItem (id, productId, orderDate, package, count, request_weight, requests)
    VALUES ('$id','$productID','$orderdate', '$product', '$count', '$weight', '$requests');";

        if (mysqli_query($conn, $insertQuery)) {
            echo '<script>alert("Form Data has been submitted.")</script>';
            echo "<script>window.location.href = 'orderitemform.php'</script>";
        } else {
            echo "Error storing form data: " . mysqli_error($conn);
        }
    } else {
        echo "<h1>Product not present in the ProductInfo table.</h1>";
    }
}
$_SESSION['user_id'] = $id;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Order Item Form</title>
</head>

<body>
    <div class="order-btn">
        <button class="order-details-btn" id="view-all-orders-btn">View Order Details</button>
    </div>
    <div class="form">
        <form action="" method="post" class="change-password-form">
            <div class=" input-box">
                <label for="orderdate">Order Date</label>
                <input type="date" id="orderdate" name="orderdate">
            </div>
            <div class=" input-box">
                <label for="company">Company</label>
                <input type="text" id="company" name="company" readonly value="<?php echo ($id); ?>">
            </div>
            <div class=" input-box">
                <label for="orderowner">Order Owner</label>
                <input type="text" id="orderowner" name="orderowner" readonly value="<?php echo ($name); ?>">
            </div>
            <div class=" input-box">
                <label for="product">Item/Product</label>
                <input type="text" id="product" name="product" placeholder="Laptop">
            </div>
            <div class=" input-box">
                <label for="count">EA/count</label>
                <input type="number" id="count" name="count" placeholder="10">
            </div>
            <div class=" input-box">
                <label for="weight">Weight</label>
                <input type="number" id="weight" name="weight" placeholder="1">
            </div>
            <div class=" input-box">
                <label for="requests">Requests</label>
                <input type="text" id="requests" name="requests" placeholder="Urgent">
            </div>
            <button class="update-password-btn" type="submit" name="submit">SUBMIT</button>
        </form>
    </div>
</body>

<script>
    const btn = document.getElementById("view-all-orders-btn")
    btn.addEventListener('click', () => {
        window.location.href = "orderDetails.php";
    })
</script>

</html>