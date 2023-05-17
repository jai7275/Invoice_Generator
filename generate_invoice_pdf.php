<?php
require_once('db_connect.php');
require('fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Invoice', 0, 1, 'C');
        $this->Cell(0, 10, 'Thanks For Shopping', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' / {nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$query = "SELECT * FROM invoice_pdf";
$result = $conn->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        // Set table headers
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Buyer Name', 1, 0, 'C');
        $pdf->Cell(80, 10, 'Products', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Price(INR)', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Total(INR)', 1, 1, 'C');

        // Set table body
        $pdf->SetFont('Arial', '', 12);
        while ($row = $result->fetch_assoc()) {
            $buyerName = $row['BuyerName'];
            $products = $row['Products'];
            $price = $row['Price'];
            $total = $row['Total'];

            $pdf->Cell(40, 10, $buyerName, 1, 0, 'C');
            $pdf->Cell(80, 10, $products, 1, 0, 'C');
            $pdf->Cell(30, 10, $price, 1, 0, 'C');
            $pdf->Cell(30, 10, $total, 1, 1, 'C');
        }
    } else {
        echo "No invoice data found.";
    }
} else {
    echo "Error retrieving invoice data: " . $conn->error;
}


$pdf->Output("invoice.pdf", "D");

$conn->close();
?>
