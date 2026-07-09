<?php

require_once "../config/koneksi.php";
require_once "PDF_Klinik.php";
require_once "signature.php";

// ======================================
// MEMBUAT PDF
// ======================================

$pdf = new PDF_Klinik('P','mm','A4');

$pdf->AliasNbPages();
$pdf->SetMargins(10,10,10);
$pdf->SetAutoPageBreak(true,35);

$pdf->setJudul("Laporan Data Obat");

$pdf->AddPage();

// ======================================
// HEADER TABEL
// ======================================

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(230,230,230);

$pdf->Cell(10,10,'No',1,0,'C',true);
$pdf->Cell(60,10,'Nama Obat',1,0,'C',true);
$pdf->Cell(40,10,'Jenis',1,0,'C',true);
$pdf->Cell(25,10,'Stok',1,0,'C',true);
$pdf->Cell(55,10,'Harga',1,1,'C',true);

// ======================================
// DATA
// ======================================

$pdf->SetFont('Arial','',10);

$no = 1;

$query = mysqli_query($koneksi,"
SELECT *
FROM obat
ORDER BY nama_obat ASC
");

while($row = mysqli_fetch_assoc($query))
{

    $pdf->Cell(10,8,$no++,1,0,'C');

    $pdf->Cell(
        60,
        8,
        utf8_decode($row['nama_obat']),
        1,
        0
    );

    $pdf->Cell(
        40,
        8,
        utf8_decode($row['jenis_obat']),
        1,
        0,
        'C'
    );

    $pdf->Cell(
        25,
        8,
        $row['stok'],
        1,
        0,
        'C'
    );

    $pdf->Cell(
        55,
        8,
        "Rp ".number_format($row['harga'],0,",","."),
        1,
        1,
        'R'
    );

}

// ======================================
// TOTAL DATA
// ======================================

$total = mysqli_num_rows($query);

$pdf->Ln(6);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(
    0,
    6,
    "Total Data Obat : ".$total,
    0,
    1
);

// ======================================
// TANDA TANGAN
// ======================================

signatureBlock($pdf);

// ======================================
// OUTPUT
// ======================================

$pdf->Output(
    'I',
    'Laporan_Data_Obat.pdf'
);

?>