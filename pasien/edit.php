<?php
include "../config/koneksi.php";

// Cek ID
if (!isset($_GET['id'])) {
    header("Location:index.php");
    exit;
}

$id = $_GET['id'];

// Ambil data pasien
$query = mysqli_query($koneksi, "SELECT * FROM pasien WHERE id_pasien='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Data Pasien</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
font-family:'Poppins',sans-serif;
}

body{

height:100vh;

background:linear-gradient(135deg,#4facfe,#00f2fe);

display:flex;

justify-content:center;

align-items:center;

overflow:hidden;

}

body::before{

content:"";

position:absolute;

width:450px;

height:450px;

background:#ffffff30;

border-radius:50%;

top:-100px;

right:-100px;

filter:blur(100px);

}

body::after{

content:"";

position:absolute;

width:450px;

height:450px;

background:#ffffff25;

border-radius:50%;

bottom:-120px;

left:-100px;

filter:blur(100px);

}

.card-glass{

position:relative;

z-index:10;

width:750px;

padding:35px;

background:rgba(255,255,255,.18);

backdrop-filter:blur(15px);

border-radius:25px;

border:1px solid rgba(255,255,255,.25);

box-shadow:0 20px 40px rgba(0,0,0,.2);

animation:fade .7s;

}

@keyframes fade{

from{

opacity:0;

transform:translateY(40px);

}

to{

opacity:1;

transform:translateY(0);

}

}

h2,p,label{

color:white;

}

label{

font-weight:500;

margin-bottom:5px;

}

.form-control,

.form-select{

border:none;

border-radius:12px;

padding:12px;

}

.form-control:focus,

.form-select:focus{

box-shadow:0 0 10px rgba(255,255,255,.7);

}

.btn{

border-radius:12px;

padding:12px;

font-weight:600;

}

.icon{

font-size:45px;

color:white;

}

</style>

</head>

<body>

<div class="card-glass">

<div class="text-center mb-4">

<div class="icon">

<i class="bi bi-pencil-square"></i>

</div>

<h2>Edit Data Pasien</h2>

<p>Silakan ubah data pasien sesuai kebutuhan.</p>

</div>

<form action="update.php" method="POST">

<input
type="hidden"
name="id_pasien"
value="<?= $data['id_pasien']; ?>">

<div class="row">

<div class="col-md-6 mb-3">

<label>Nama Pasien</label>

<input
type="text"
name="nama_pasien"
class="form-control"
value="<?= $data['nama_pasien']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Jenis Kelamin</label>

<select
name="jenis_kelamin"
class="form-select"
required>

<option value="Laki-laki"
<?= ($data['jenis_kelamin']=="Laki-laki")?"selected":""; ?>>
Laki-laki
</option>

<option value="Perempuan"
<?= ($data['jenis_kelamin']=="Perempuan")?"selected":""; ?>>
Perempuan
</option>

</select>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Umur</label>

<input
type="number"
name="umur"
class="form-control"
value="<?= $data['umur']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>No HP</label>

<input
type="text"
name="no_hp"
class="form-control"
value="<?= $data['no_hp']; ?>"
required>

</div>

</div>

<div class="mb-4">

<label>Alamat</label>

<textarea
name="alamat"
rows="4"
class="form-control"
required><?= $data['alamat']; ?></textarea>

</div>

<div class="d-grid gap-2 d-md-flex justify-content-end">

<a
href="index.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left-circle"></i>

Kembali

</a>

<button
type="submit"
class="btn btn-warning text-white">

<i class="bi bi-check-circle-fill"></i>

Update Data

</button>

</div>

</form>

</div>

</body>

</html>