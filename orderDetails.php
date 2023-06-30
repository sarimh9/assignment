<?php
session_start();
include("connection.php");

$id = $_SESSION['user_id'];
$query = "SELECT * FROM `OrderItem` WHERE id = $id;";
$result = mysqli_query($conn, $query);

if ($result) {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Error: " . mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>View Order Details</title>
</head>

<body>
    <div class="export order-btn">
        <a href="export.php">
            <button class="excel-export-btn order-details-btn">Export to Excel</button>
        </a>
    </div>
    <h1 class="details-h1">Already Filled Order Details for ID : <?php echo $id ?></h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product ID</th>
                <th>Package</th>
                <th>Result Weight</th>
                <th>Order Date</th>
                <th>Order ID</th>
                <th>Requests</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['productId']; ?></td>
                    <td><?php echo $row['package']; ?></td>
                    <td><?php echo $row['request_weight']; ?></td>
                    <td><?php echo $row['orderDate']; ?></td>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['requests']; ?></td>
                    <td><?php echo $row['count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>