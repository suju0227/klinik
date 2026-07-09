<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Pasien</title>

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

/* Background Blur */

body::before{

content:"";

position:absolute;

width:500px;

height:500px;

background:#ffffff30;

border-radius:50%;

top:-120px;

right:-100px;

filter:blur(90px);

}

body::after{

content:"";

position:absolute;

width:450px;

height:450px;

background:#ffffff20;

border-radius:50%;

bottom:-120px;

left:-100px;

filter:blur(100px);

}

/* Card */

.card-glass{

position:relative;

z-index:10;

width:750px;

background:rgba(255,255,255,.18);

backdrop-filter:blur(15px);

border:1px solid rgba(255,255,255,.3);

border-radius:25px;

padding:35px;

box-shadow:0 20px 40px rgba(0,0,0,.18);

animation:fade .8s;

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

h2{

font-weight:700;

color:white;

}

p{

color:white;

opacity:.9;

}

label{

font-weight:500;

color:white;

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

.btn-success{

background:#16a34a;

border:none;

}

.btn-success:hover{

background:#15803d;

}

.btn-secondary{

background:#64748b;

border:none;

}

.icon{

font-size:45px;

color:white;

margin-bottom:10px;

}

</style>

</head>

<body>

<div class="card-glass">

<div class="text-center mb-4">

<div class="icon">

<i class="bi bi-person-plus-fill"></i>

</div>

<h2>Tambah Data Pasien</h2>

<p>Silakan lengkapi seluruh data pasien di bawah ini.</p>

</div>

<form action="simpan.php" method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Nama Pasien</label>

<input type="text"

name="nama_pasien"

class="form-control"

placeholder="Masukkan nama pasien"

required>

</div>

<div class="col-md-6 mb-3">

<label>Jenis Kelamin</label>

<select

name="jenis_kelamin"

class="form-select"

required>

<option value="">-- Pilih --</option>

<option>Laki-laki</option>

<option>Perempuan</option>

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

placeholder="Masukkan umur"

required>

</div>

<div class="col-md-6 mb-3">

<label>No HP</label>

<input

type="text"

name="no_hp"

class="form-control"

placeholder="08xxxxxxxxxx"

required>

</div>

</div>

<div class="mb-4">

<label>Alamat</label>

<textarea

name="alamat"

rows="4"

class="form-control"

placeholder="Masukkan alamat lengkap"

required></textarea>

</div>

<div class="d-grid gap-2 d-md-flex justify-content-end">

<a href="index.php"

class="btn btn-secondary">

<i class="bi bi-arrow-left-circle"></i>

Kembali

</a>

<button

type="submit"

class="btn btn-success">

<i class="bi bi-save-fill"></i>

Simpan Data

</button>

</div>

</form>

</div>

</body>

</html>