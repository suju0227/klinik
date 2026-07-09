<?php

function signatureBlock($pdf)
{

    $bulan=[
        1=>"Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember"
    ];

    $tanggal=date('d')." ".$bulan[(int)date('m')]." ".date('Y');

    // Kalau hampir habis halaman,
    // pindah ke halaman baru

    if($pdf->GetY()>245)
    {
        $pdf->AddPage();
    }

    $pageWidth=$pdf->GetPageWidth();

    $pdf->Ln(10);

    $left=$pageWidth-90;

    $pdf->SetFont('Arial','',11);

    $pdf->Cell($left);

    $pdf->Cell(
        80,
        6,
        "Makassar, ".$tanggal,
        0,
        1,
        'C'
    );

    $pdf->Cell($left);

    $pdf->Cell(
        80,
        6,
        "Mengetahui,",
        0,
        1,
        'C'
    );

    $pdf->Cell($left);

    $pdf->Cell(
        80,
        6,
        "Administrator Klinik",
        0,
        1,
        'C'
    );

    $pdf->Ln(18);

    $pdf->SetFont('Arial','B',11);

    $pdf->Cell($left);

    $pdf->Cell(
        80,
        6,
        "( ____________________ )",
        0,
        1,
        'C'
    );

}