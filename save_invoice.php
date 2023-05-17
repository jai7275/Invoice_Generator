<?php
require_once('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $buyerName = $_POST['buyerName'];
    $products = $_POST['products'];
    $price = $_POST['price'];
    $total = $_POST['total'];

    $sql = "INSERT INTO invoice_pdf (BuyerName, Products, Price, Total) VALUES ('$buyerName', '$products', '$price', '$total')";

    if ($conn->query($sql) === TRUE) {
        echo "Your Given Data saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Download Invoice</title>
</head>
<body>
    <h1>Download Invoice</h1>

    <form action="generate_invoice_pdf.php" method="post">
        <input type="hidden" name="buyerName" value="John Doe">
        <input type="hidden" name="products" value="Product 1, Product 2">
        <input type="hidden" name="price" value="100">
        <input type="hidden" name="total" value="200">
        <input type="submit" name="downloadInvoice" value="Download Invoice">
    </form>
</body>
</html>