<?php
include "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nama_layanan = mysqli_real_escape_string($koneksi, $_POST['nama_layanan']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    $simpan = mysqli_query($koneksi, "
        INSERT INTO layanan
        (nama_layanan, harga, keterangan)
        VALUES
        ('$nama_layanan','$harga','$keterangan')
    ");

    if ($simpan) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Berhasil</title>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        </head>
        <body>

        <script>

        Swal.fire({

            icon:'success',

            title:'Berhasil',

            text:'Data layanan berhasil ditambahkan.',

            confirmButtonColor:'#198754'

        }).then(function(){

            window.location='index.php';

        });

        </script>

        </body>
        </html>
        <?php

    } else {

        ?>
        <!DOCTYPE html>
        <html>
        <head>

            <title>Gagal</title>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        </head>
        <body>

        <script>

        Swal.fire({

            icon:'error',

            title:'Gagal',

            text:'Data layanan gagal disimpan.',

            confirmButtonColor:'#dc3545'

        }).then(function(){

            window.history.back();

        });

        </script>

        </body>
        </html>
        <?php

    }

} else {

    header("Location:index.php");

}
?>