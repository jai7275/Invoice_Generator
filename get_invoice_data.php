<?php
require_once('db_connect.php');

$query = "SELECT * FROM invoice_pdf";
$result = $conn->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $buyerName = $row['BuyerName'];
            $products = $row['Products'];
            $price = $row['Price'];
            $total = $row['Total'];

            // Process the data as needed
            // You can output the data or store it in an array for later use
            echo "Buyer Name: " . $buyerName . "<br>";
            echo "Products: " . $products . "<br>";
            echo "Price: " . $price . "<br>";
            echo "Total: " . $total . "<br><br>";
        }
    } else {
        echo "No invoice data found.";
    }
} else {
    echo "Error retrieving invoice data: " . $conn->error;
}

$conn->close();
?>
