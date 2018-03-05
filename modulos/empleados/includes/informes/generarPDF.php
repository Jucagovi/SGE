<?php

header("Content-type:application/pdf");
header("Content-Disposition:attachment;filename='downloaded.pdf'");

require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Hello World!');
$pdf->Output();
?>