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

$pdf->setJudul("Laporan Data Pembayaran");

$pdf->AddPage();

// ======================================
// HEADER TABEL
// ======================================

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(230,230,230);

$pdf->Cell(10,10,'No',1,0,'C',true);
$pdf->Cell(45,10,'Pasien',1,0,'C',true);
$pdf->Cell(40,10,'Dokter',1,0,'C',true);
$pdf->Cell(28,10,'Tgl Bayar',1,0,'C',true);
$pdf->Cell(35,10,'Metode',1,0,'C',true);
$pdf->Cell(35,10,'Total Bayar',1,0,'C',true);
$pdf->Cell(104,10,'Rincian Layanan',1,1,'C',true);

// ======================================
// DATA PEMBAYARAN
// ======================================

$pdf->SetFont('Arial','',9);

$no=1;

$query=mysqli_query($koneksi,"
SELECT
    pembayaran.*,
    pasien.nama_pasien,
    dokter.nama_dokter
FROM pembayaran

LEFT JOIN pemeriksaan
ON pembayaran.id_pemeriksaan=pemeriksaan.id_pemeriksaan

LEFT JOIN pasien
ON pemeriksaan.id_pasien=pasien.id_pasien

LEFT JOIN dokter
ON pemeriksaan.id_dokter=dokter.id_dokter

ORDER BY pembayaran.tanggal_bayar DESC
");

while($row=mysqli_fetch_assoc($query))
{

    // ===============================
    // Ambil rincian layanan
    // ===============================

    $layanan="";

    $detail=mysqli_query($koneksi,"
    SELECT
        layanan.nama_layanan,
        detail_pemeriksaan.jumlah
    FROM detail_pemeriksaan

    LEFT JOIN layanan
    ON detail_pemeriksaan.id_layanan=layanan.id_layanan

    WHERE detail_pemeriksaan.id_pemeriksaan='".$row['id_pemeriksaan']."'
    ");

    while($d=mysqli_fetch_assoc($detail))
    {
        $layanan .=
        "- ".
        $d['nama_layanan'].
        " x".$d['jumlah'].
        "\n";
    }

    $x=$pdf->GetX();
    $y=$pdf->GetY();

    $pdf->Cell(10,8,$no++,1,0,'C');

    $pdf->Cell(
        45,
        8,
        utf8_decode($row['nama_pasien']),
        1,
        0
    );

    $pdf->Cell(
        40,
        8,
        utf8_decode($row['nama_dokter']),
        1,
        0
    );

    $pdf->Cell(
        28,
        8,
        date('d-m-Y',strtotime($row['tanggal_bayar'])),
        1,
        0,
        'C'
    );

    $pdf->Cell(
        35,
        8,
        $row['metode_pembayaran'],
        1,
        0,
        'C'
    );

    $pdf->Cell(
        35,
        8,
        "Rp ".number_format($row['total_bayar'],0,",","."),
        1,
        0,
        'R'
    );

    $pdf->MultiCell(
        104,
        8,
        utf8_decode(trim($layanan)),
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
    "Total Data Pembayaran : ".$total,
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
    "Laporan_Data_Pembayaran.pdf"
);

?>