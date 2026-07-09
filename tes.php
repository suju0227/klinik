<?php
require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(60,10,'FPDF BERHASIL');
$pdf->Output();