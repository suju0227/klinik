<?php

require_once "../config/koneksi.php";
require_once "../fpdf/fpdf.php";

if(!isset($_GET['id']))
{
    die("ID Pembayaran tidak ditemukan.");
}

$id = intval($_GET['id']);

$query = mysqli_query($koneksi,"
SELECT
    pembayaran.*,
    pasien.nama_pasien,
    dokter.nama_dokter,
    pemeriksaan.tanggal_periksa

FROM pembayaran

JOIN pemeriksaan
ON pembayaran.id_pemeriksaan=pemeriksaan.id_pemeriksaan

JOIN pasien
ON pemeriksaan.id_pasien=pasien.id_pasien

JOIN dokter
ON pemeriksaan.id_dokter=dokter.id_dokter

WHERE pembayaran.id_pembayaran='$id'
");

$data=mysqli_fetch_assoc($query);

if(!$data)
{
    die("Data tidak ditemukan.");
}

$pdf=new FPDF('P','mm',array(80,180));

$pdf->AddPage();

$pdf->SetMargins(5,5,5);


// ================================
// LOGO
// ================================

$logo="../assets/img/logo.png";

if(file_exists($logo))
{
    $pdf->Image($logo,28,5,24);
}

$pdf->Ln(22);

// ================================
// HEADER
// ================================

$pdf->SetFont('Arial','B',12);

$pdf->Cell(70,6,"KLINIK YAKUSA",0,1,'C');

$pdf->SetFont('Arial','',8);

$pdf->Cell(70,4,"Sistem Manajemen Klinik",0,1,'C');

$pdf->Cell(70,4,"Jl. Imam Inlu Amal No.1947",0,1,'C');

$pdf->Cell(70,4,"Telp. 0856-5619-1731",0,1,'C');

$pdf->Ln(2);

$pdf->Cell(70,0,'','T',1);

$pdf->Ln(3);

// ================================
// DATA
// ================================

$pdf->SetFont('Arial','',8);

$pdf->Cell(25,5,"No Struk");
$pdf->Cell(45,5,": ".$data['id_pembayaran'],0,1);

$pdf->Cell(25,5,"Tanggal");
$pdf->Cell(
    45,
    5,
    ": ".date(
        'd-m-Y',
        strtotime($data['tanggal_bayar'])
    ),
    0,
    1
);

$pdf->Cell(25,5,"Pasien");
$pdf->Cell(45,5,": ".$data['nama_pasien'],0,1);

$pdf->Cell(25,5,"Dokter");
$pdf->Cell(45,5,": ".$data['nama_dokter'],0,1);

$pdf->Cell(25,5,"Metode");
$pdf->Cell(45,5,": ".$data['metode_pembayaran'],0,1);

$pdf->Ln(2);

$pdf->Cell(70,0,'','T',1);

$pdf->Ln(3);

// ================================
// RINCIAN LAYANAN
// ================================

$pdf->SetFont('Arial','B',8);

$pdf->Cell(30,6,"Layanan");
$pdf->Cell(10,6,"Qty",0,0,'C');
$pdf->Cell(30,6,"Subtotal",0,1,'R');

$pdf->SetFont('Arial','',8);

$total=0;

$detail=mysqli_query($koneksi,"
SELECT
    layanan.nama_layanan,
    layanan.harga,
    detail_pemeriksaan.jumlah

FROM detail_pemeriksaan

JOIN layanan
ON detail_pemeriksaan.id_layanan=layanan.id_layanan

WHERE detail_pemeriksaan.id_pemeriksaan='".$data['id_pemeriksaan']."'
");

while($d=mysqli_fetch_assoc($detail))
{

    $subtotal=
    $d['harga']*
    $d['jumlah'];

    $total+=$subtotal;

    $pdf->Cell(
        30,
        5,
        $d['nama_layanan']
    );

    $pdf->Cell(
        10,
        5,
        $d['jumlah'],
        0,
        0,
        'C'
    );

    $pdf->Cell(
        30,
        5,
        number_format($subtotal,0,",","."),
        0,
        1,
        'R'
    );

}

$pdf->Ln(2);

$pdf->Cell(70,0,'','T',1);

$pdf->Ln(2);

// ================================
// TOTAL
// ================================

$pdf->SetFont('Arial','B',9);

$pdf->Cell(35,6,"TOTAL");

$pdf->Cell(
    35,
    6,
    "Rp ".number_format($total,0,",","."),
    0,
    1,
    'R'
);

$pdf->Ln(5);

// ================================
// FOOTER
// ================================

$pdf->SetFont('Arial','I',8);

$pdf->MultiCell(
    70,
    4,
    "Terima kasih telah berobat di Klinik Yakusa.\nSemoga lekas sembuh.",
    0,
    'C'
);

$pdf->Ln(3);

$pdf->Cell(
    70,
    4,
    "*** SIMPAN STRUK INI ***",
    0,
    1,
    'C'
);

$pdf->Output();