<?php

require_once "../config/koneksi.php";
require_once "PDF_Klinik.php";
require_once "signature.php";

// ======================================
// MEMBUAT PDF
// ======================================

$pdf = new PDF_Klinik('L','mm','A4');

$pdf->AliasNbPages();
$pdf->SetMargins(10,10,10);
$pdf->SetAutoPageBreak(true,35);

$pdf->setJudul("Laporan Data Pemeriksaan");

$pdf->AddPage();

// ======================================
// HEADER TABEL
// ======================================

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(230,230,230);

$pdf->Cell(10,10,'No',1,0,'C',true);
$pdf->Cell(45,10,'Pasien',1,0,'C',true);
$pdf->Cell(45,10,'Dokter',1,0,'C',true);
$pdf->Cell(30,10,'Tanggal',1,0,'C',true);
$pdf->Cell(75,10,'Keluhan',1,0,'C',true);
$pdf->Cell(82,10,'Diagnosa',1,1,'C',true);

// ======================================
// DATA
// ======================================

$pdf->SetFont('Arial','',10);

$no=1;

$query=mysqli_query($koneksi,"
SELECT
    pemeriksaan.*,
    pasien.nama_pasien,
    dokter.nama_dokter
FROM pemeriksaan

LEFT JOIN pasien
ON pemeriksaan.id_pasien=pasien.id_pasien

LEFT JOIN dokter
ON pemeriksaan.id_dokter=dokter.id_dokter

ORDER BY pemeriksaan.tanggal_periksa DESC
");

while($row=mysqli_fetch_assoc($query))
{

    $pdf->Cell(10,8,$no++,1,0,'C');

    $pdf->Cell(
        45,
        8,
        utf8_decode($row['nama_pasien']),
        1,
        0
    );

    $pdf->Cell(
        45,
        8,
        utf8_decode($row['nama_dokter']),
        1,
        0
    );

    $pdf->Cell(
        30,
        8,
        date('d-m-Y',strtotime($row['tanggal_periksa'])),
        1,
        0,
        'C'
    );

    $pdf->Cell(
        75,
        8,
        utf8_decode(substr($row['keluhan'],0,45)),
        1,
        0
    );

    $pdf->Cell(
        82,
        8,
        utf8_decode(substr($row['diagnosa'],0,50)),
        1,
        1
    );

}

// ======================================
// TOTAL DATA
// ======================================

$total=mysqli_num_rows($query);

$pdf->Ln(6);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(
    0,
    6,
    "Total Data Pemeriksaan : ".$total,
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
    "I",
    "Laporan_Data_Pemeriksaan.pdf"
);

?>