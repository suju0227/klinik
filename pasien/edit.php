<?php
include "../config/koneksi.php";

// Cek ID
if (!isset($_GET['id'])) {
    header("Location:index.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data pasien
$query = mysqli_query($koneksi, "SELECT * FROM pasien WHERE id_pasien='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location:index.php");
    exit;
}

include "../layout/header.php";
?>

<div class="wrapper">

    <?php include "../layout/sidebar.php"; ?>

    <div class="main">

        <?php include "../layout/navbar.php"; ?>

        <div class="container-fluid py-4">

            <div class="row justify-content-center">

                <div class="col-lg-8">

                    <div class="card card-glass shadow border-0 rounded-4">

                        <div class="card-header bg-success text-white rounded-top-4">

                            <h3 class="mb-0">

                                <i class="fas fa-edit"></i>

                                Edit Data Pasien

                            </h3>

                            <small>Silakan ubah data pasien sesuai kebutuhan.</small>

                        </div>

                        <div class="card-body p-4">

                            <form action="update.php" method="POST">

                                <input type="hidden" name="id_pasien" value="<?= $data['id_pasien']; ?>">

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">Nama Pasien</label>

                                        <input type="text"

                                            name="nama_pasien"

                                            class="form-control"

                                            value="<?= htmlspecialchars($data['nama_pasien']); ?>"

                                            required>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">Jenis Kelamin</label>

                                        <select name="jenis_kelamin" class="form-select" required>

                                            <option value="Laki-laki" <?= ($data['jenis_kelamin']=="Laki-laki")?"selected":""; ?>>

                                                Laki-laki

                                            </option>

                                            <option value="Perempuan" <?= ($data['jenis_kelamin']=="Perempuan")?"selected":""; ?>>

                                                Perempuan

                                            </option>

                                        </select>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">Umur</label>

                                        <input type="number"

                                            name="umur"

                                            class="form-control"

                                            value="<?= $data['umur']; ?>"

                                            required>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">No HP</label>

                                        <input type="text"

                                            name="no_hp"

                                            class="form-control"

                                            value="<?= htmlspecialchars($data['no_hp']); ?>"

                                            required>

                                    </div>

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">Alamat</label>

                                    <textarea name="alamat"

                                        rows="4"

                                        class="form-control"

                                        required><?= htmlspecialchars($data['alamat']); ?></textarea>

                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-end">

                                    <a href="index.php" class="btn btn-secondary">

                                        <i class="fas fa-arrow-left"></i>

                                        Kembali

                                    </a>

                                    <button type="submit" class="btn btn-success">

                                        <i class="fas fa-save"></i>

                                        Update Data

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include "../layout/footer.php"; ?>