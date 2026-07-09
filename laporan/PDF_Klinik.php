<?php

require_once __DIR__ . '/../fpdf/fpdf.php';

class PDF_Klinik extends FPDF
{
    private $judul = "";

    public function setJudul($judul)
    {
        $this->judul = strtoupper($judul);
    }

    // ======================================
    // HEADER
    // ======================================
    function Header()
    {
        $pageWidth = $this->GetPageWidth();

        $margin = 10;

        $contentWidth = $pageWidth - ($margin * 2);

        $logo = __DIR__ . '/../assets/img/logo.png';

        if(file_exists($logo))
        {
            $this->Image($logo,10,8,22);
        }

        $this->SetFont('Arial','B',18);
        $this->Cell($contentWidth,8,'KLINIK YAKUSA',0,1,'C');

        $this->SetFont('Arial','',11);
        $this->Cell($contentWidth,6,'Sistem Manajemen Klinik',0,1,'C');

        $this->SetFont('Arial','',10);
        $this->Cell($contentWidth,5,'Jl. Iman Ilmu Amal No.1947 ',0,1,'C');

        $this->Cell($contentWidth,5,'Telp. 0856-5619-1731',0,1,'C');

        $this->Ln(2);

        $y = $this->GetY();

        $this->SetLineWidth(0.6);

        $this->Line(
            $margin,
            $y,
            $pageWidth-$margin,
            $y
        );

        $this->SetLineWidth(0.2);

        $this->Line(
            $margin,
            $y+1,
            $pageWidth-$margin,
            $y+1
        );

        $this->Ln(5);

        $this->SetFont('Arial','B',15);

        $this->Cell(
            $contentWidth,
            8,
            $this->judul,
            0,
            1,
            'C'
        );

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

        $this->SetFont('Arial','',10);

        $this->Cell(
            $contentWidth,
            6,
            "Tanggal Cetak : ".$tanggal,
            0,
            1,
            'R'
        );

        $this->Ln(4);
    }

    // ======================================
    // FOOTER
    // ======================================
    function Footer()
    {
        $this->SetY(-10);

        $this->SetFont('Arial','I',8);

        $this->Cell(
            0,
            5,
            "Halaman ".$this->PageNo()." / {nb}",
            0,
            0,
            'C'
        );
    }
}