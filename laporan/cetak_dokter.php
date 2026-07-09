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

$pdf->setJudul("Laporan Data Dokter");

$pdf->AddPage();

// ======================================
// HEADER TABEL
// ======================================

$pdf->SetFont('Arial','B',10);

$pdf->SetFillColor(230,230,230);

$pdf->Cell(10,10,'No',1,0,'C',true);
$pdf->Cell(55,10,'Nama Dokter',1,0,'C',true);
$pdf->Cell(45,10,'Spesialis',1,0,'C',true);
$pdf->Cell(35,10,'No. HP',1,0,'C',true);
$pdf->Cell(45,10,'Alamat',1,1,'C',true);

// ======================================
// DATA
// ======================================

$pdf->SetFont('Arial','',10);

$no = 1;

$query = mysqli_query($koneksi,"
SELECT *
FROM dokter
ORDER BY nama_dokter ASC
");

while($row = mysqli_fetch_assoc($query))
{

    $pdf->Cell(10,8,$no++,1,0,'C');

    $pdf->Cell(
        55,
        8,
        utf8_decode($row['nama_dokter']),
        1,
        0
    );

    $pdf->Cell(
        45,
        8,
        utf8_decode($row['spesialis']),
        1,
        0
    );

    $pdf->Cell(
        35,
        8,
        $row['no_hp'],
        1,
        0,
        'C'
    );

    $pdf->Cell(
        45,
        8,
        utf8_decode(substr($row['alamat'],0,28)),
        1,
        1
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
    "Total Data Dokter : ".$total,
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
    'Laporan_Data_Dokter.pdf'
);

?>