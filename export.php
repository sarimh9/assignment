<?php
session_start();
include("connection.php");

$id = $_SESSION['user_id'];
$query = "SELECT * FROM `OrderItem` WHERE id = $id;";
$result = mysqli_query($conn, $query);

$filename = 'report.csv';
$file = fopen($filename, 'w');

fputs($file, "\xEF\xBB\xBF");

fputcsv($file, ['ID', 'Product ID', 'Package', 'Result Weight', 'Order Date', 'Order ID', 'Requests', 'Count']);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($file, $row);
}

fclose($file);

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

// Output the CSV file
readfile($filename);

// Delete the temporary CSV file
unlink($filename);
?>
