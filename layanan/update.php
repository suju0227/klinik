<?php
include "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = mysqli_real_escape_string($koneksi, $_POST['id_layanan']);
    $nama_layanan = mysqli_real_escape_string($koneksi, $_POST['nama_layanan']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    $update = mysqli_query($koneksi, "
        UPDATE layanan
        SET
            nama_layanan = '$nama_layanan',
            harga = '$harga',
            keterangan = '$keterangan'
        WHERE id_layanan = '$id'
    ");

    if ($update) {
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

            icon: 'success',

            title: 'Berhasil',

            text: 'Data layanan berhasil diperbarui.',

            confirmButtonColor: '#198754'

        }).then(function(){

            window.location = 'index.php';

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

            icon: 'error',

            title: 'Gagal',

            text: 'Data layanan gagal diperbarui.',

            confirmButtonColor: '#dc3545'

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