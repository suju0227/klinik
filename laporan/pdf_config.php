<?php

require_once __DIR__ . '/../fpdf/fpdf.php';

/*
|--------------------------------------------------------------------------
| KONFIGURASI PDF KLINIK YAKUSA
|--------------------------------------------------------------------------
|
| File ini digunakan oleh seluruh laporan PDF.
| Jangan mengatur margin, font, atau AutoPageBreak lagi
| di file laporan (pasien, dokter, pembayaran, dll).
|
*/

class PDF_Klinik extends FPDF
{

    // Nomor halaman otomatis
    function Footer()
    {
        // Posisi 12 mm dari bawah
        $this->SetY(-12);

        // Font
        $this->SetFont('Arial','I',8);

        // Nomor halaman
        $this->Cell(
            0,
            5,
            'Halaman '.$this->PageNo(),
            0,
            0,
            'C'
        );
    }

}


/*
|--------------------------------------------------------------------------
| Fungsi Membuat PDF
|--------------------------------------------------------------------------
|
| portrait  = P
| landscape = L
|
*/

function buatPDF($orientasi='P')
{

    $pdf = new PDF_Klinik($orientasi,'mm','A4');

    // Margin
    $pdf->SetMargins(10,10,10);

    // Margin footer
    $pdf->SetAutoPageBreak(true,30);

    // Alias jumlah halaman
    $pdf->AliasNbPages();

    // Font default
    $pdf->SetFont('Arial','',10);

    return $pdf;

}

?>